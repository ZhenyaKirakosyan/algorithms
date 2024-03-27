<?php

namespace BinaryTrees;

class BinarySearchTree
{
    public function __construct(public ?Node $root = null) { }

    public function insert(int $value): void
    {
        if ($this->root == null) {
            $this->root = new Node($value);
        } else {
            $this->insertNode(new Node($value), $this->root);
        }
    }

    private function insertNode(?Node $newNode, ?Node &$node): void
    {
        if (!$node) {
            $node = $newNode;
        } elseif ($newNode->value > $node->value) {
            $this->insertNode($newNode, $node->right);
        } else {
            $this->insertNode($newNode, $node->left);
        }
    }

    public function search(int $value)
    {
        return $this->searchNode($this->root, $value);
    }

    private function searchNode(Node $node, int $value)
    {
        if ($node == null) return null;

        if ($value == $node->value) {
            return $node;
        } elseif ($value < $node->value) {
            return $this->searchNode($node->left, $value);
        } else {
            return $this->searchNode($node->right, $value);
        }
    }
}

$bst = new BinarySearchTree();
$values = [10, 5, 15, 3, 7, 12, 18, 2, 32, 0, 4];
foreach ($values as $value) {
    $bst->insert($value);
}

print_r([$bst->search(15)]);

print_r($bst);