<?php

/**
 * Twig Try Catch
 *
 * @copyright 2022 Dennis Morhardt <info@dennismorhardt.de>
 * @license MIT License; see LICENSE file for details.
 */

namespace Gglnx\TwigTryCatch\Extension;

use Gglnx\TwigTryCatch\TokenParser\TryCatchTokenParser;
use Twig\Extension\AbstractExtension;

/**
 * This extension registers the try/catch token parser.
 *
 * @author Dennis Morhardt <info@dennismorhardt.de>
 * @package Gglnx\TwigTryCatch\Extension
 */
class TryCatchExtension extends AbstractExtension
{
    /**
     * @inheritdoc
     */
    public function getTokenParsers(): array
    {
        return [
            new TryCatchTokenParser(),
        ];
    }
}
