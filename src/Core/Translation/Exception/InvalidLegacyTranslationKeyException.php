<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

declare(strict_types=1);

namespace PrestaShop\PrestaShop\Core\Translation\Exception;

use PrestaShop\PrestaShop\Core\Exception\CoreException;
use Throwable;

/**
 * Thrown when an invalid key is found in a legacy translation file
 */
class InvalidLegacyTranslationKeyException extends CoreException
{
    /**
     * @var string The invalid key
     */
    private $key;

    public function __construct(string $missingElement, string $key, $code = 0, ?Throwable $previous = null)
    {
        $message = sprintf('Invalid key in legacy translation file: "%s" (missing %s)', $key, $missingElement);
        $this->key = $key;

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }
}
