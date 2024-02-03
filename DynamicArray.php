<?php

class DynamicArray {
    public array $array;
    public int $capacity;
    public int $size;

    public function __construct(array $array)
    {
        $this->array = $array;
        $this->size = count($array);
        $this->capacity = count($array) ?: 1;
    }

    public function pushBack(int $value): void
    {
        if ($this->capacity == $this->size) {
            $this->capacity *= 2;
            $newArray = array_fill(0, $this->size + 1, null);

            for ($i = 0; $i < $this->size; $i++) {
                $newArray[$i] = $this->array[$i];
            }

            $newArray[$this->size] = $value;
            $this->array = $newArray;
        } else {
            $this->array[$this->size] = $value;
        }

        ++$this->size;
    }

    public function pushFront(int $value): void
    {
        if ($this->capacity == $this->size) {
            $this->capacity *= 2;
        }

        $newArray = array_fill(0, $this->size + 1, null);
        $newArray[0] = $value;

        for ($i = 0; $i < $this->size; $i++) {
            $newArray[$i + 1] = $this->array[$i];
        }

        $this->array = $newArray;
        ++$this->size;
    }

    public function remove(int $from, ?int $to = null)
    {
        $newArray = [];

        for($i = 0; $i < count($this->array); $i++)
        {
            if (($to == null && $i == $from) || ($i >= $from && $i <= $to)) {
                --$this->size;
                continue;
            }

            $newArray[] = $this->array[$i];
        }

        $this->array = $newArray;
    }

    public function shrinkToFit()
    {
        $this->capacity = $this->size;
    }

    public function insert(int $position, array $data): void
    {
        $newArray = array_fill(0, $this->size + count($data), null);
        $position = min($position, count($this->array));

        for ($i = 0; $i < $position; $i++) {
            $newArray[$i] = $this->array[$i];
        }

        for ($j = 0; $j < count($data); $j++) {
            if ($this->capacity == $this->size) {
                $this->capacity *= 2;
            }

            $newArray[$j + $position] = $data[$j];
            ++$this->size;
        }

        if ($position < count($this->array)) {
            for ($t = $position; $t < count($this->array); $t++) {
                $newArray[$j + $t] = $this->array[$t];
            }
        }

        $this->array = $newArray;
    }

    public function resize(int $count, $value): void
    {
        $newArray = array_fill(0, $count, null);

        for ($i = 0; $i < $count; $i++) {
            $newArray[$i] = $value;
        }

        $this->insert($this->size, $newArray);
    }
}