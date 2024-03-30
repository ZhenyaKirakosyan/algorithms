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

    public function search(int $value): ?Node
    {
        return $this->searchNode($this->root, $value);
    }

    private function searchNode(?Node $node, int $value): ?Node
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

    public function delete(int $value): ?Node
    {
        return $this->deleteNode($value, $this->root);
    }

    public function deleteNode(int $value, ?Node $node): ?Node
    {
        if ($node === null) return null;

        if ($value < $node->value) {
            $node->left = $this->deleteNode($value, $node->left);
        } elseif ($value > $node->value) {
            $node->right = $this->deleteNode($value, $node->right);
        } else {
            if ($node->left === null) return $node->right;
            $succ = $this->getMin($node->right);
            $node->value = $succ->value;

            $node->right = $this->deleteNode($succ->value, $node->right);
        }

        return $node;
    }

    public function getPredecessor(Node $node): ?Node
    {
        if ($node->left) return $this->getMax($node->left);

        /** @var Node $pre */
        $pre = null;
        /** @var Node $next */
        $next = $this->root;

        while ($next !== $node) {
            if ($next->value < $node->value) {
                $pre = $next;
                $next = $next->right;
            } else {
                $next = $next->left;
            }
        }

        return $pre;
    }

    public function getSuccessor(Node $node): ?Node
    {
        if ($node->right) return $this->getMin($node->right);

        /** @var Node $succ */
        $succ = null;
        /** @var Node $next */
        $next = $this->root;

        while ($next !== $node) {
            if ($next->value > $node->value) {
                $succ = $next;
                $next = $next->left;
            } else {
                $next = $next->right;
            }
        }

        return $succ;
    }

    public function getMin(Node $node): Node
    {
        while ($node->left !== null) {
            $node = $node->left;
        }

        return $node;
    }

    public function getMax(Node $node): Node
    {
        while ($node->right !== null) {
            $node = $node->right;
        }

        return $node;
    }
}

$bst = new BinarySearchTree();
$values = [10, 5, 15, 3, 7, 12, 18, 2, 32, 0, 4];
foreach ($values as $value) {
    $bst->insert($value);
}

//print_r([$bst->search(15)]);
//$bst->delete(5);

$bst2 = new BinarySearchTree();
$values2 = [10, 5, 20, 3, 7, 11, 19, 18, 17, 15];
foreach ($values2 as $value) {
    $bst2->insert($value);
}
// print_r($bst2);
print_r($bst2->getPredecessor($bst2->search(18)));
print_r($bst2->getSuccessor($bst2->search(18)));