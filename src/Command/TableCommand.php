<?php
declare(strict_types = 1);

namespace Toolkit\Command;

use Bake\Command\BakeCommand;
use Bake\Utility\TableScanner;
use Bake\Utility\TemplateRenderer;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Table;
use Cake\Utility\Inflector;

class TableCommand extends BakeCommand
{

    /**
     * path to Model directory
     *
     * @var string
     */
    public $pathFragment = 'Tables/';

    /**
     * Table prefix
     *
     * Can be replaced in application subclasses if necessary
     *
     * @var string
     */
    public string $tablePrefix = '';

    protected function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = $this->_setCommonOptions($parser);

        $parser->setDescription(
            'Bake table class for Html Tables system.'
        )->addArgument('name', [
            'help' => 'Name of the table to bake (without the database Table suffix). ' .
                      'You can use Plugin.name to bake plugin models.',
            ])->addOption('table', [
                'help' => 'The table name to use if you have non-conventional table names.',
            ])
         ->setEpilog(
            'Omitting all arguments and options will list the table names you can generate models for.'
        );

        return parent::buildOptionParser($parser);
    }


    /**
     * Execute the command.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return int|null The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io): ?int
    {

        $this->extractCommonProperties($args);
        $name = $this->_getName($args->getArgument('name') ?? '');

        if (empty($name)) {
            $io->out('Choose a table to bake from the following:');
            foreach ($this->listUnskipped() as $table) {
                $io->out('- ' . $this->_camelize($table));
            }

            return static::CODE_SUCCESS;
        }

        $this->bake($this->_camelize($name), $args, $io);

        return static::CODE_SUCCESS;
    }



    /**
     * Generate code for the given model name.
     *
     * @param string $name The model name to generate.
     * @param \Cake\Console\Arguments $args Console Arguments.
     * @param \Cake\Console\ConsoleIo $io Console Io.
     * @return void
     */
    public function bake(string $name, Arguments $args, ConsoleIo $io): void
    {
        $table = $this->getTable($name, $args);
        $tableObject = $this->getTableObject($name, $table);
        $data = $this->getTableContext($tableObject, $table, $name, $args, $io);
        $this->bakeTable($tableObject, $data, $args, $io);
    }



    /**
     * Bake a table class.
     *
     * @param \Cake\ORM\Table $model Model name or object
     * @param array $data An array to use to generate the Table
     * @param \Cake\Console\Arguments $args CLI Arguments
     * @param \Cake\Console\ConsoleIo $io CLI Arguments
     * @return void
     */
    public function bakeTable(Table $model, array $data, Arguments $args, ConsoleIo $io): void
    {
        if ($args->getOption('no-table')) {
            return;
        }

        $namespace = Configure::read('App.namespace');
        $pluginPath = '';
        if ($this->plugin) {
            $namespace = $this->_pluginNamespace($this->plugin);
        }

        $name = $model->getAlias();
        $entity = $this->_entityName($model->getAlias());
        $tableName = $model->getAlias();
        $data += [
            'plugin' => $this->plugin,
            'pluginPath' => $pluginPath,
            'namespace' => $namespace,
            'name' => $name,
            'entity' => $entity,
            'entityFQN' => get_class($model->newEmptyEntity()),
            'table' => null,
            'tableName' => $tableName,
            'connection' => $this->connection,
        ];
        if (Inflector::camelize($data['table']) === $data['name']) {
            $data['table'] = null;
        }

        $renderer = new TemplateRenderer($this->theme);
        $renderer->set($data);
        $out = $renderer->generate('Toolkit.Tables/table');

        $path = $this->getPath($args);
        $filename = $path . $name . '.php';
        $io->out("\n" . sprintf('Baking table class for %s...', $name), 1, ConsoleIo::QUIET);
        $io->createFile($filename, $out, $args->getOption('force'));

        // Work around composer caching that classes/files do not exist.
        // Check for the file as it might not exist in tests.
        if (file_exists($filename)) {
            require_once $filename;
        }
        $this->getTableLocator()->clear();

        $emptyFile = $path . 'Table' . DS . '.gitkeep';
        $this->deleteEmptyFile($emptyFile, $io);
    }



    /**
     * Get table context for baking a given table.
     *
     * @param \Cake\ORM\Table $tableObject The model name to generate.
     * @param string $table The table name for the model being baked.
     * @param string $name The model name to generate.
     * @param \Cake\Console\Arguments $args CLI Arguments
     * @param \Cake\Console\ConsoleIo $io CLI io
     * @return array
     */
    public function getTableContext(
        Table $tableObject,
        string $table,
        string $name,
        Arguments $args,
        ConsoleIo $io
    ): array {
        $fields = $this->getFields($tableObject, $args);
        $connection = $this->connection;

        return compact(
            'table',
            'fields',
            'connection',
        );
    }

    /**
     * Get the table name for the model being baked.
     *
     * Uses the `table` option if it is set.
     *
     * @param string $name Table name
     * @param \Cake\Console\Arguments $args The CLI arguments
     * @return string
     */
    public function getTable(string $name, Arguments $args): string
    {
        if ($args->getOption('table')) {
            return (string)$args->getOption('table');
        }

        return Inflector::underscore($name);
    }



    /**
     * Get a model object for a class name.
     *
     * @param string $className Name of class you want model to be.
     * @param string $table Table name
     * @return \Cake\ORM\Table Table instance
     */
    public function getTableObject(string $className, string $table): Table
    {
        if (!empty($this->plugin)) {
            $className = $this->plugin . '.' . $className;
        }

        if ($this->getTableLocator()->exists($className)) {
            return $this->getTableLocator()->get($className);
        }

        return $this->getTableLocator()->get($className, [
            'name' => $className,
            'table' => $this->tablePrefix . $table,
            'connection' => ConnectionManager::get($this->connection),
        ]);
    }



    /**
     * Evaluates the fields and no-fields options, and
     * returns if, and which fields should be made accessible.
     *
     * If no fields are specified and the `no-fields` parameter is
     * not set, then all non-primary key fields + association
     * fields will be set as accessible.
     *
     * @param \Cake\ORM\Table $table The table instance to get fields for.
     * @param \Cake\Console\Arguments $args CLI Arguments
     * @return string[]|false|null Either an array of fields, `false` in
     *   case the no-fields option is used, or `null` if none of the
     *   field options is used.
     */
    public function getFields(Table $table, Arguments $args)
    {
        if ($args->getOption('no-fields')) {
            return false;
        }
        if ($args->getOption('fields')) {
            $fields = explode(',', $args->getOption('fields'));

            return array_values(array_filter(array_map('trim', $fields)));
        }
        $schema = $table->getSchema();
        $fieldsIndexes = $schema->columns();
        $fields = [];
        foreach ($fieldsIndexes as $index => $field) {
            $fields[$index] = [
                'name' => $field,
                'type' => $schema->getColumnType($field),
            ];
        }

        return $fields;
    }

    /**
     * Outputs the a list of unskipped models or controllers from database
     *
     * @return string[]
     */
    public function listUnskipped(): array
    {
        /** @var \Cake\Database\Connection $connection */
        $connection = ConnectionManager::get($this->connection);
        $scanner = new TableScanner($connection);

        return $scanner->listUnskipped();
    }
}