<?php
/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Enterprise License (PEL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @category   Pimcore
 *
 * @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 * @license    http://www.pimcore.org/license     GPLv3 and PEL
 */

namespace Pimcore\Model\DataObject\ClassDefinition\Data;

use Pimcore\Model;

class Input extends Model\DataObject\ClassDefinition\Data
{
    use Model\DataObject\ClassDefinition\Data\Extension\Text;
    use Model\DataObject\Traits\SimpleComparisonTrait;

    /**
     * Static type of this element
     *
     * @var string
     */
    public $fieldtype = 'input';

    /**
     * @var int
     */
    public $width;

    /**
     * Type for the column to query
     *
     * @var string
     */
    public $queryColumnType = 'varchar';

    /**
     * Type for the column
     *
     * @var string
     */
    public $columnType = 'varchar';

    /**
     * Column length
     *
     * @var int
     */
    public $columnLength = 190;

    /**
     * Type for the generated phpdoc
     *
     * @var string
     */
    public $phpdocType = 'string';

    /**
     * @var string
     */
    public $regex = '';

    /**
     * @var bool
     */
    public $unique;

    /**
     * @var bool
     */
    public $showCharCount;

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     *
     * @return $this
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @see Model\DataObject\ClassDefinition\Data::getDataForResource
     *
     * @param string $data
     * @param null|Model\DataObject\AbstractObject $object
     * @param mixed $params
     *
     * @return string
     */
    public function getDataForResource($data, $object = null, $params = [])
    {
        return $data;
    }

    /**
     * @see Model\DataObject\ClassDefinition\Data::getDataFromResource
     *
     * @param string $data
     * @param null|Model\DataObject\AbstractObject $object
     * @param mixed $params
     *
     * @return string
     */
    public function getDataFromResource($data, $object = null, $params = [])
    {
        return $data;
    }

    /**
     * @see Model\DataObject\ClassDefinition\Data::getDataForQueryResource
     *
     * @param string $data
     * @param null|Model\DataObject\AbstractObject $object
     * @param mixed $params
     *
     * @return string
     */
    public function getDataForQueryResource($data, $object = null, $params = [])
    {
        return $data;
    }

    /**
     * @see Model\DataObject\ClassDefinition\Data::getDataForEditmode
     *
     * @param string $data
     * @param null|Model\DataObject\AbstractObject $object
     * @param mixed $params
     *
     * @return string
     */
    public function getDataForEditmode($data, $object = null, $params = [])
    {
        return $this->getDataForResource($data, $object, $params);
    }

    /**
     * @see Model\DataObject\ClassDefinition\Data::getDataFromEditmode
     *
     * @param string $data
     * @param null|Model\DataObject\AbstractObject $object
     * @param mixed $params
     *
     * @return string
     */
    public function getDataFromEditmode($data, $object = null, $params = [])
    {
        return $this->getDataFromResource($data, $object, $params);
    }

    /**
     * @param float $data
     * @param Model\DataObject\Concrete $object
     * @param mixed $params
     *
     * @return float
     */
    public function getDataFromGridEditor($data, $object = null, $params = [])
    {
        return $this->getDataFromEditmode($data, $object, $params);
    }

    /**
     * @return int
     */
    public function getColumnLength()
    {
        return $this->columnLength;
    }

    /**
     * @param $columnLength
     *
     * @return $this
     */
    public function setColumnLength($columnLength)
    {
        if ($columnLength) {
            $this->columnLength = $columnLength;
        }

        return $this;
    }

    /**
     * @param string $regex
     */
    public function setRegex($regex)
    {
        $this->regex = $regex;
    }

    /**
     * @return string
     */
    public function getRegex()
    {
        return $this->regex;
    }

    /**
     * @return bool
     */
    public function getUnique()
    {
        return $this->unique;
    }

    /**
     * @param bool $unique
     */
    public function setUnique($unique)
    {
        $this->unique = $unique;
    }

    /**
     * @return bool
     */
    public function getShowCharCount()
    {
        return $this->showCharCount;
    }

    /**
     * @param bool $showCharCount
     */
    public function setShowCharCount($showCharCount)
    {
        $this->showCharCount = $showCharCount;
    }


    /**
     * @return string
     */
    public function getColumnType()
    {
        return $this->columnType . '(' . $this->getColumnLength() . ')';
    }

    /**
     * @return string
     */
    public function getQueryColumnType()
    {
        return $this->queryColumnType . '(' . $this->getColumnLength() . ')';
    }

    /**
     * Checks if data is valid for current data field
     *
     * @param mixed $data
     * @param bool $omitMandatoryCheck
     *
     * @throws \Exception
     */
    public function checkValidity($data, $omitMandatoryCheck = false)
    {
        if (!$omitMandatoryCheck && $this->getRegex() && strlen($data) > 0) {
            if (!preg_match('#' . $this->getRegex() . '#', $data)) {
                throw new Model\Element\ValidationException('Value in field [ ' . $this->getName() . " ] doesn't match input validation '" . $this->getRegex() . "'");
            }
        }

        parent::checkValidity($data, $omitMandatoryCheck);
    }

    /**
     * @param Model\DataObject\ClassDefinition\Data $masterDefinition
     */
    public function synchronizeWithMasterDefinition(Model\DataObject\ClassDefinition\Data $masterDefinition)
    {
        $this->columnLength = $masterDefinition->columnLength;
    }
}
