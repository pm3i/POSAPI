<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PosCategory
 *
 * @ORM\Table(name="pos_category")
 * @ORM\Entity
 */
class PosCategory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $category_id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=250)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=250)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="create_time", type="string", length=1000)
     */
    private $create_time;

    /**
     * @var string
     *
     * @ORM\Column(name="update_time", type="string", length=1000)
     */
    private $update_time;

    /**
     * @var integer
     *
     * @ORM\Column(name="flag", type="integer")
     */
    private $flag;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="integer")
     */
    private $parent_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="cate_type", type="integer")
     */
    private $cate_type;

    /**
     * @var string
     *
     * @ORM\Column(name="company_code", type="string", length=255)
     */
    private $company_code;


    /**
     * Set category_id
     *
     * @param integer $categoryId
     * @return PosCategory
     */
    public function setCategoryId($categoryId)
    {
        $this->category_id = $categoryId;

        return $this;
    }

    /**
     * Get category_id
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return PosCategory
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return PosCategory
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set create_time
     *
     * @param string $createTime
     * @return PosCategory
     */
    public function setCreateTime($createTime)
    {
        $this->create_time = $createTime;

        return $this;
    }

    /**
     * Get create_time
     *
     * @return string 
     */
    public function getCreateTime()
    {
        return $this->create_time;
    }

    /**
     * Set update_time
     *
     * @param string $updateTime
     * @return PosCategory
     */
    public function setUpdateTime($updateTime)
    {
        $this->update_time = $updateTime;

        return $this;
    }

    /**
     * Get update_time
     *
     * @return string 
     */
    public function getUpdateTime()
    {
        return $this->update_time;
    }

    /**
     * Set flag
     *
     * @param integer $flag
     * @return PosCategory
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * Get flag
     *
     * @return integer 
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * Set parent_id
     *
     * @param integer $parentId
     * @return PosCategory
     */
    public function setParentId($parentId)
    {
        $this->parent_id = $parentId;

        return $this;
    }

    /**
     * Get parent_id
     *
     * @return integer 
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * Set cate_type
     *
     * @param integer $cateType
     * @return PosCategory
     */
    public function setCateType($cateType)
    {
        $this->cate_type = $cateType;

        return $this;
    }

    /**
     * Get cate_type
     *
     * @return integer 
     */
    public function getCateType()
    {
        return $this->cate_type;
    }

    /**
     * Set company_code
     *
     * @param string $companyCode
     * @return PosCategory
     */
    public function setCompanyCode($companyCode)
    {
        $this->company_code = $companyCode;

        return $this;
    }

    /**
     * Get company_code
     *
     * @return string 
     */
    public function getCompanyCode()
    {
        return $this->company_code;
    }
}
