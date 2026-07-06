<?php

namespace Panelis\Setting\Drivers;

class DriverManager
{
    /**
     * @var array<class-string<Driver>, array<string, Driver>>
     */
    protected array $drivers = [];

    public function register(Driver $driver): static
    {
        $type = get_parent_class($driver);

        $this->drivers[$type][$driver->name()] = $driver;

        return $this;
    }

    /**
     * @template T of Driver
     *
     * @param  class-string<T>  $type
     * @return array<T>
     */
    public function all(string $type): array
    {
        $drivers = $this->drivers[$type] ?? [];

        uasort($drivers, function (Driver $a, Driver $b): int {
            $sort = $a->sort() <=> $b->sort();

            if ($sort !== 0) {
                return $sort;
            }

            return strcasecmp($a->label(), $b->label());
        });

        return array_values($drivers);
    }

    /**
     * @template T of Driver
     *
     * @param  class-string<T>  $type
     */
    public function find(string $type, string $name): ?Driver
    {
        return $this->drivers[$type][$name] ?? null;
    }

    /**
     * @template T of Driver
     *
     * @param  class-string<T>  $type
     */
    public function has(string $type, string $name): bool
    {
        return isset($this->drivers[$type][$name]);
    }
}
