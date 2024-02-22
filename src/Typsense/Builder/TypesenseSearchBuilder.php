<?php
declare(strict_types=1);

namespace Builder;

/**
 * @author  Adi Permana Putra <adiputrapermana@gmail.com>
 */
class TypesenseSearchBuilder
{
    protected array $filterBy = [];
    protected array $sortBy = [];

    public function where(string $parameter, $value): self
    {
        if (is_bool($value)) {
            $value = $value ? 'true' : 'false';
        }

        $this->filterBy[] = sprintf('%s:=%s', $parameter, $value);

        return $this;
    }

    public function whereIn(string $parameter, array $values): self
    {
        $this->filterBy[] = sprintf('%s:=%s', $parameter, '[' . implode(', ', $values) . ']');

        return $this;
    }

    public function whereNotIn(string $parameter, array $values): self
    {
        $this->filterBy[] = sprintf('%s:!=%s', $parameter, '[' . implode(', ', $values) . ']');

        return $this;
    }

    public function whereNum(string $parameter, string $compare, $value): self
    {
        $this->filterBy[] = sprintf('%s:%s%s', $parameter, $compare, $value);

        return $this;
    }

    public function orderByLocation(float $latitude, float $longitude): self
    {
        $this->sortBy[] = sprintf('location(%s, %s):asc', $latitude, $longitude);

        return $this;
    }

    public function orderBy(string $parameter, string $direction): self
    {
        $this->sortBy[] = sprintf('%s:%s', $parameter, $direction);

        return $this;
    }

    public function build(): array
    {
        return array_filter(
            [
                'filter_by' => filled($this->filterBy) ? implode(' && ', $this->filterBy) : null,
                'sort_by'   => filled($this->sortBy) ? implode(',', $this->sortBy) : null,
            ]
        );
    }
}