<?php

namespace LinkedList;

class Node
{
    public function __construct(public mixed $value, public ?Node $prev = null, public ?Node $next = null) { }
}

class DoublyLinkedList
{
    public function __construct(public ?Node $head = null, public ?Node $tail = null) { }

    public function printByNext(): void
    {
        $node = $this->head;

        while ($node) {
            echo $node->value . ' ';

            $node = $node->next;
        }

        echo "\n";
    }

    public function printByPrev(): void
    {
        $node = $this->tail;

        while ($node) {
            echo $node->value . ' ';

            $node = $node->prev;
        }

        echo "\n";
    }

    public function pushBack(mixed $value): void
    {
        $newNode = new Node($value);
        $current = $this->head;

        if (!$current) {
            $this->head = $newNode;
        } else {
            while ($current->next) {
                $current = $current->next;
            }

            $current->next = $newNode;
            $newNode->prev = $current;
        }

        $this->tail = $newNode;
    }

    public function popBack(): void
    {
        $last = $this->tail;

        if (!$last) {
            echo "List is empty PB \n";
        } else {
            if ($last->prev) {
                $last->prev->next = null;
            } else {
                $this->head = null;
            }

            $this->tail = $last->prev;
        }
    }

    public function pushFront(mixed $value): void
    {
        $newNode = new Node($value);

        if ($this->head) {
            $newNode->next = $this->head;
            $this->head->prev = $newNode;
        } else {
            $this->tail = $newNode;
        }

        $this->head = $newNode;
    }

    public function popFront(): void
    {
        $first = $this->head;

        if (!$first) {
            echo "List is empty PF \n";
        } else {
            if ($first->next) {
                $first->next->prev = null;
            } else {
                $this->tail = null;
            }

            $this->head = $first->next;
        }
    }

    public function insert(mixed $value, int $position, int $count = 1): void
    {
        $newNode = new Node($value);
        $current = $this->head;

        if ($current && $position > 1) {
            while ($current && $position > 2) {
                $current = $current->next;
                $position--;
            }

            if (!$current || !$current->next) {
                for ($j = 1; $j <= $count; $j++) {
                    $this->pushBack($value);
                }
            } else {
                $newNode->prev = $current;
                $newNode->next = $current->next;
                $current->next->prev = $newNode;
                $current->next = $newNode;

                for ($j = 1; $j < $count; $j++) {
                    $lastNewNode = new Node($value);
                    $lastNewNode->prev = $newNode;
                    $lastNewNode->next = $newNode->next;
                    $newNode->next->prev = $lastNewNode;
                    $newNode->next = $lastNewNode;
                    $newNode = $lastNewNode;
                }
            }
        } else {
            for ($j = 1; $j <= $count; $j++) {
                $this->pushFront($value);
            }
        }
    }
}

$node = new Node(3);
$list = new DoublyLinkedList();
$list->insert(0, 0, 2);
$list->insert(2, 3, 2);
$list->insert(1, 3, 2);
$list->insert(4, 14, 2);
$list->insert(3, 0, 2);
$list->printByNext();
$list->printByPrev();


//$list->pushBack(4);
//$list->pushBack(5);
//$list->pushBack(6);
//$list->printByNext();
//$list->printByPrev();
//$list->popBack();
//$list->printByNext();
//$list->printByPrev();
//$list->popBack();
//$list->popBack();
//$list->popBack();
//$list->printByNext();
//$list->printByPrev();
//$list->pushBack(0);
//$list->printByNext();
//$list->printByPrev();
//$list->pushFront(-1);
//$list->pushFront(-2);
//$list->printByNext();
//$list->printByPrev();
//$list->popFront();
//$list->popFront();
//$list->popFront();
//$list->printByNext();
//$list->printByPrev();
