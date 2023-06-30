<?php
declare(strict_types=1);


namespace Toolkit\Tables;


use Cake\Utility\Inflector;

class Column
{
    private string $_key;

    private string|null $_title;

    private array $_options;

    private array $_attributes;

    private bool $_database;

    private bool $_searchable;

    private bool $_orderable;

    /**
     * Column constructor.
     *
     * @param string $key
     * @param string|null $title
     * @param array $options
     * @param array $attributes
     * @param false $database
     * @param bool $searchable
     * @param bool $orderable
     */
    public function __construct(string $key, string|null $title = null, array $options = [], array $attributes = [], bool $database = false, bool $searchable = false, bool $orderable = false)
    {
        $this->_key = $key;
        if (empty($title)) {
            $titles = explode('.', $key);
            foreach ($titles as $index => $title) {
                $title = preg_replace('/_id$/', '', $title);
                if ($index == 0) {
                    $title = Inflector::singularize($title);
                }
                $titles[$index] = Inflector::humanize($title);
            }
            $title = implode(' ', $titles);
        }
        $this->_title = $title;
        $this->_options = $options;
        $this->_attributes = $attributes;
        $this->_database = $database;
        $this->_searchable = $searchable;
        $this->_orderable = $orderable;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->_key;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->_title;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->_options;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->_attributes;
    }

    /**
     * @return bool
     */
    public function isDatabase(): bool
    {
        return $this->_database;
    }

    /**
     * @return bool
     */
    public function isSearchable(): bool
    {
        return $this->_searchable;
    }

    /**
     * @param bool $searchable
     */
    public function setSearchable(bool $searchable): void
    {
        $this->_searchable = $searchable;
    }

    /**
     * @return bool
     */
    public function isOrderable(): bool
    {
        return $this->_orderable;
    }

    /**
     * @param bool $orderable
     */
    public function setOrderable(bool $orderable): void
    {
        $this->_orderable = $orderable;
    }

}