<?php

/**
 * Twig Try Catch
 *
 * @copyright 2022 Dennis Morhardt <info@dennismorhardt.de>
 * @copyright 2015-2022 Trilby Media, LLC
 * @license MIT License; see LICENSE file for details.
 */

namespace Gglnx\TwigTryCatch\Node;

use LogicException;
use Twig\Compiler;
use Twig\Node\Node;

/**
 * Node for try/catch construct
 *
 * @author Dennis Morhardt <info@dennismorhardt.de>
 * @package Gglnx\TwigTryCatch\Node
 */
class TryCatchNode extends Node
{
    /**
     * @param Node $try
     * @param Node|null $catch
     * @param int $lineno
     * @param string|null $tag
     */
    public function __construct(Node $try, Node $catch = null, $lineno = 0, $tag = null)
    {
        $nodes = ['try' => $try, 'catch' => $catch];
        $nodes = array_filter($nodes);

        parent::__construct($nodes, [], $lineno, $tag);
    }

    /**
     * Compiles the node to PHP.
     *
     * @param Compiler $compiler A Twig Compiler instance
     * @return void
     * @throws LogicException
     */
    public function compile(Compiler $compiler): void
    {
        $compiler->addDebugInfo($this);

        $compiler->write('try {');

        $compiler
            ->indent()
            ->subcompile($this->getNode('try'))
            ->outdent()
            ->write('} catch (\Throwable $e) {' . "\n")
            ->indent()
            ->write('$context[\'e\'] = $e;' . "\n");

        if ($this->hasNode('catch')) {
            $compiler->subcompile($this->getNode('catch'));
        }

        $compiler
            ->outdent()
            ->write("}\n");
    }
}
