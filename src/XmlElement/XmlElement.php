<?php


namespace lornkarios\YandexTurboPages\XmlElement;


class XmlElement
{
    /**
     * @var XmlElement[]
     */
    private array $children = [];
    private bool $isCdataOwner = false;
    private ?string $namespace;

    /**
     * @return XmlElement[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    public function getNamespace(): ?string
    {
        return $this->namespace;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @return array|null
     */
    public function getAttributes(): ?array
    {
        return $this->attributes;
    }


    private string $name;
    private ?string $value;
    private ?array $attributes;

    public function __construct(string $name, string $value = null, array $attributes = null, bool $isCdataOwner = null, string $namespace = null)
    {
        if (!is_null($isCdataOwner)) {
            $this->isCdataOwner = $isCdataOwner;
        }
        $this->name = $name;
        $this->setValue($value);
        $this->attributes = $attributes;

        $this->namespace = $namespace;
    }

    private function setValue(string $value = null)
    {
        if (is_null($value)) {
            $value = ' ';
        }
        if ($this->isCdataOwner === false) {
            $value = htmlspecialchars($value);
        }
        $this->value = $value;
    }

    public function addChild(XmlElement $element): XmlElement
    {
        $this->children[] = $element;
        return $element;
    }

    public function toXml(\SimpleXMLElement $xml): string
    {
        if (empty($this->children)) {
            if($this->isCdataOwner){
                $element = $xml->addChild($this->getName(), null, $this->getNamespace());
                $dom = dom_import_simplexml($element);
                $elementOwner = $dom->ownerDocument;
                $dom->appendChild($elementOwner->createCDATASection($this->getValue()));
            }else{
                $element = $xml->addChild($this->getName(), $this->getValue(),$this->getNamespace());
            }
        } else {
            $element = $xml->addChild($this->getName(),null,$this->getNamespace());
        }
        if ($this->attributes) {
            foreach ($this->attributes as $name => $attribute) {
                $element->addAttribute($name,$attribute);
            }
        }

        foreach ($this->children as $child) {
            $child->toXml($element);
        }
        return $xml->asXML();
    }
}