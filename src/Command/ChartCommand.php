<?php

declare(strict_types = 1);

namespace Toolkit\Command;

use Bake\Command\BakeCommand;
use Bake\Utility\TemplateRenderer;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Core\Configure;
use Cake\Utility\Inflector;

class ChartCommand extends BakeCommand
{

    /**
     * path to Model directory
     *
     * @var string
     */
    public $pathFragment = 'ApexCharts/';

    /**
     * Execute the command.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return int|null The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io): ?int
    {
        $name = $this->_getName($args->getArgument('name') ?? '');

        if (empty($name)) {
            $io->out('Choose a chart name to bake!');

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
        $this->bakeTable($name, $args, $io);
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
    public function bakeTable(string $name, Arguments $args, ConsoleIo $io): void
    {
        $name = Inflector::camelize($name) . 'Chart';
        $namespace = Configure::read('App.namespace');

        $data = [
            'namespace' => $namespace,
            'name' => $name,
        ];

        $renderer = new TemplateRenderer($this->theme);
        $renderer->set($data);
        $out = $renderer->generate('Toolkit.ApexCharts/chart');

        $path = $this->getPath($args);
        $filename = $path . $name . '.php';
        $io->out("\n" . sprintf('Baking chart class for %s...', $name), 1, ConsoleIo::QUIET);
        $io->createFile($filename, $out, $args->getOption('force'));

        // Work around composer caching that classes/files do not exist.
        // Check for the file as it might not exist in tests.
        if (file_exists($filename)) {
            require_once $filename;
        }
        $this->getTableLocator()->clear();

        $emptyFile = $path .'.gitkeep';
        $this->deleteEmptyFile($emptyFile, $io);
    }

    protected function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = $this->_setCommonOptions($parser);

        $parser->setDescription(
            'Bake chart class for charts system.'
        )->addArgument('name', [
            'help' => 'Name of the chart to bake. ',
        ])
               ->setEpilog(
                   'Omitting all arguments and options will list the table names you can generate models for.'
               );

        return parent::buildOptionParser($parser);
    }
}