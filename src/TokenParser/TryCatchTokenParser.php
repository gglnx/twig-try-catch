<?php

/**
 * Twig Try Catch
 *
 * @copyright 2022 Dennis Morhardt <info@dennismorhardt.de>
 * @copyright 2015-2022 Trilby Media, LLC
 * @license MIT License; see LICENSE file for details.
 */

namespace Gglnx\TwigTryCatch\TokenParser;

use Gglnx\TwigTryCatch\Node\TryCatchNode;
use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;

/**
 * Adds parser for try/catch syntax.
 *
 * <pre>
 * {% try %}
 *    <li>{{ user.get('name') }}</li>
 * {% catch %}
 *    {{ e.message }}
 * {% endcatch %}
 * </pre>
 *
 * @author Dennis Morhardt <info@dennismorhardt.de>
 * @package Gglnx\TwigTryCatch\TokenParser
 */
class TryCatchTokenParser extends AbstractTokenParser
{
    /**
     * Parses a token and returns a node.
     *
     * @param Token $token
     * @return TryCatchNode
     * @throws SyntaxError
     */
    public function parse(Token $token)
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();

        $stream->expect(Token::BLOCK_END_TYPE);
        $try = $this->parser->subparse([$this, 'decideCatch']);
        $stream->next();
        $stream->expect(Token::BLOCK_END_TYPE);
        $catch = $this->parser->subparse([$this, 'decideEnd']);
        $stream->next();
        $stream->expect(Token::BLOCK_END_TYPE);

        return new TryCatchNode($try, $catch, $lineno, $this->getTag());
    }

    /**
     * @param Token $token
     * @return bool
     */
    public function decideCatch(Token $token): bool
    {
        return $token->test(['catch']);
    }

    /**
     * @param Token $token
     * @return bool
     */
    public function decideEnd(Token $token): bool
    {
        return $token->test(['endtry']) || $token->test(['endcatch']);
    }

    /**
     * Gets the tag name associated with this token parser.
     *
     * @return string The tag name
     */
    public function getTag(): string
    {
        return 'try';
    }
}
