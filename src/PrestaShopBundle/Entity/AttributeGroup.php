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

namespace PrestaShopBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;

/**
 * AttributeGroup.
 *
 * @ORM\Table()
 *
 * @ORM\Entity(repositoryClass="PrestaShopBundle\Entity\Repository\AttributeGroupRepository")
 */
class AttributeGroup
{
    /**
     * @var int
     *
     * @ORM\Id
     *
     * @ORM\Column(name="id_attribute_group", type="integer")
     *
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_color_group", type="boolean")
     */
    private $isColorGroup;

    /**
     * @var string
     *
     * @ORM\Column(name="group_type", type="string", length=255)
     */
    private $groupType;

    /**
     * @var int
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="PrestaShopBundle\Entity\Attribute", mappedBy="attributeGroup", orphanRemoval=true)
     */
    private $attributes;

    /**
     * @ORM\ManyToMany(targetEntity="PrestaShopBundle\Entity\Shop", cascade={"persist"})
     *
     * @ORM\JoinTable(
     *      joinColumns={@ORM\JoinColumn(name="id_attribute_group", referencedColumnName="id_attribute_group")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_shop", referencedColumnName="id_shop", onDelete="CASCADE")}
     * )
     */
    private $shops;

    /**
     * @var ArrayCollection<AttributeGroupLang>
     *
     * @ORM\OneToMany(targetEntity="PrestaShopBundle\Entity\AttributeGroupLang", mappedBy="attributeGroup", orphanRemoval=true)
     */
    private $attributeGroupLangs;

    private $groupTypeAvailable = [
        'select',
        'radio',
        'color',
    ];

    public function __construct()
    {
        $this->groupType = 'select';
        $this->shops = new ArrayCollection();
        $this->attributes = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set isColorGroup.
     *
     * @param bool $isColorGroup
     *
     * @return AttributeGroup
     */
    public function setIsColorGroup($isColorGroup)
    {
        $this->isColorGroup = $isColorGroup;

        return $this;
    }

    /**
     * Get isColorGroup.
     *
     * @return bool
     */
    public function getIsColorGroup()
    {
        return $this->isColorGroup;
    }

    /**
     * Set groupType.
     *
     * @param string $groupType
     *
     * @return AttributeGroup
     */
    public function setGroupType($groupType)
    {
        if (!in_array($groupType, $this->groupTypeAvailable)) {
            throw new InvalidArgumentException('Invalid group type');
        }

        $this->groupType = $groupType;

        return $this;
    }

    /**
     * Get groupType.
     *
     * @return string
     */
    public function getGroupType()
    {
        return $this->groupType;
    }

    /**
     * Set position.
     *
     * @param int $position
     *
     * @return AttributeGroup
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position.
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return Collection<Attribute>
     */
    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    /**
     * Add shop.
     *
     * @param Shop $shop
     *
     * @return AttributeGroup
     */
    public function addShop(Shop $shop)
    {
        $this->shops[] = $shop;

        return $this;
    }

    /**
     * Remove shop.
     *
     * @param Shop $shop
     */
    public function removeShop(Shop $shop)
    {
        $this->shops->removeElement($shop);
    }

    /**
     * Get shops.
     *
     * @return Collection
     */
    public function getShops()
    {
        return $this->shops;
    }

    public function addAttributeGroupLang(AttributeGroupLang $attributeGroupLang)
    {
        $this->attributeGroupLangs[] = $attributeGroupLang;

        $attributeGroupLang->setAttributeGroup($this);

        return $this;
    }

    public function removeAttributeGroupLang(AttributeGroupLang $attributeGroupLang)
    {
        $this->attributeGroupLangs->removeElement($attributeGroupLang);
    }

    /**
     * @return Collection<AttributeGroupLang>
     */
    public function getAttributeGroupLangs()
    {
        return $this->attributeGroupLangs;
    }
}
