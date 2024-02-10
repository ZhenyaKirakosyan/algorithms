<?php

namespace LinkedList;

class Node
{
    public function __construct(public mixed $value, public ?Node $next = null) { }
}

class SinglyLinkedList
{
    public function __construct(public ?Node $head = null) { }

    public function print(): void
    {
        $node = $this->head;

        while ($node) {
            echo $node->value . ' ';

            $node = $node->next;
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
        }
    }

    public function popBack(): void
    {
        $current = $this->head;

        if (!$current) {
            echo "List is empty PB \n";
        } else {
            while ($current->next && $current->next->next) {
                $current = $current->next;
            }

            $current->next = null;
        }
    }

    public function pushFront(mixed $value): void
    {
        $newNode = new Node($value);

        if ($this->head) {
            $newNode->next = $this->head;
        }

        $this->head = $newNode;
    }

    public function popFront(): void
    {
        if (!$this->head) {
            echo "List is empty PF \n";
        } else {
            $this->head = $this->head->next ?: null;
        }
    }

    public function insert(mixed $value, int $position, int $count = 1): void
    {
        $newNode = new Node($value);
        $current = $this->head;

        if ($current && $position > 0) {
            for ($i = 1; $i < $position; $i++) {
                if ($current->next) {
                    $current = $current->next;
                } else {
                    break;
                }
            }

            $newNode->next = $current->next;
            $current->next = $newNode;

            for ($j = 1; $j < $count; $j++) {
                $lastNewNode = new Node($value);
                $lastNewNode->next = $newNode->next;
                $newNode->next = $lastNewNode;
            }
        } else {
            $this->pushFront($value);
        }
    }

    public function remove(int $position, int $count = 1): void
    {
        $current = $this->head;

        if (!$current) {
            echo "List is empty - remove \n";
        } else {
            if ($position <= 1) {
                while ($current && $count) {
                    $current = $current->next;
                    $count--;
                }

                $this->head = $current;
            } else {
                while ($current && $position > 2) {
                    $current = $current->next;
                    $position--;
                }

                if ($position > 2) {
                    echo 'Wrong position';
                }

                while ($current->next && $count) {
                    $current->next = $current->next->next;
                    $count--;
                }
            }
        }
    }

    public function insertSLL(SinglyLinkedList $list, int $position): void
    {
        $current = $this->head;
        $listLastElement = $list->head;

        if (!$current || !$listLastElement) {
            echo "List is empty - insertSLL \n";
        } else {
            while ($listLastElement->next) {
                $listLastElement = $listLastElement->next;
            }

            if ($position <= 1) {
                $listLastElement->next = $this->head;
                $this->head = $list->head;
            } else {
                while ($current && $position > 2) {
                    $current = $current->next;
                    $position--;
                }

                $listLastElement->next = $current->next;
                $current->next = $list->head;
            }
        }
    }
}

$list = new SinglyLinkedList();
$list->insert(4, 2);
$list->insert(3, 2);
$list->insert(2, 2);
$list->insert(56, 0);
$list->insert(77, 1);
$list->insert(12, 100);
// $list->insert(90, 2, 5);
$list->print();

$newList = new SinglyLinkedList(new Node(1111));
$list->insertSLL($newList, 1);
$newList1 = new SinglyLinkedList(new Node(2222));
$list->insertSLL($newList1, 4);
$list->print();

//$list->remove(3, 5);
//$list->print();
//$list->popBack();
//$list->popFront();
//$list->pushBack(6);
//$list->print();
//$list->popFront();
//$list->print();
//$list->pushFront(1);
//$list->print();
//$list->popBack();
//$list->popFront();
//$list->print();
