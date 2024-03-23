<?php

namespace BinaryTrees;

use Helper;

class Heap
{
    public function __construct(private int $size = 0) {}

    public function buildMaxHeap(array &$arr)
    {
        $this->size = count($arr);

        for ($i = $this->size/2 - 1; $i >= 0; $i--) {
            $this->maxHeapify($arr, $i);
        }
    }

    private function maxHeapify(array &$arr, int $i): void
    {
        $largest = $i;
        $left = $this->getLeftChild($i);
        $right = $this->getRightChild($i);

        if ($left < $this->size && $arr[$left] > $arr[$largest]) {
            $largest = $left;
        }

        if ($right < $this->size && $arr[$right] > $arr[$largest]) {
            $largest = $right;
        }

        if ($largest != $i) {
            Helper::swap($arr, $i, $largest);
            $this->maxHeapify($arr, $largest);
        }
    }

    public function buildMinHeap(array &$arr)
    {
        $this->size = count($arr);

        for ($i = $this->size/2 - 1; $i >= 0; $i--) {
            $this->minHeapify($arr, $i);
        }
    }

    private function minHeapify(array &$arr, int $i): void
    {
        $smallest = $i;
        $left = $this->getLeftChild($i);
        $right = $this->getRightChild($i);

        if ($left < $this->size && $arr[$left] < $arr[$smallest]) {
            $smallest = $left;
        }

        if ($right < $this->size && $arr[$right] < $arr[$smallest]) {
            $smallest = $right;
        }

        if ($smallest != $i) {
            Helper::swap($arr, $i, $smallest);
            $this->minHeapify($arr, $smallest);
        }
    }

    private function getLeftChild(int $parent)
    {
        return 2*$parent + 1;
    }

    private function getRightChild(int $parent)
    {
        return 2*$parent + 2;
    }
}

$arr = [4, 1, 3, 2, 16, 9, 10, 14, 8, 7];
$arr1 = [4, 1, 3, 2, 16, 9, 10, 14, 8, 7];
$heap = new Heap();
$heap->buildMaxHeap($arr);
print_r($arr); // [16, 14, 10, 8, 7, 9, 3, 2, 4, 1]
$heap->buildMinHeap($arr1);
print_r($arr1); // [1, 2, 3, 4, 7, 9, 10, 14, 8, 16]