# thephplab/entities

[![Build Status](https://travis-ci.org/thephplab/entities.svg?branch=master)](https://travis-ci.org/thephplab/entities)
[![Code Coverage](https://scrutinizer-ci.com/g/thephplab/entities/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/thephplab/entities/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/thephplab/entities/v/stable)](https://packagist.org/packages/thephplab/entities)

This package provide a way to implements entities. Useful for your services or repositories.

## Usage

Create your entity in dedicated class :

```php
use Entities\Entity;

class Human extends Entity
{
    public $name;
    public $age;
}
```

Then instanciate a new entity like that :

```php
$human = new Human([
    'name' => 'Bob',
    'age' => 42,
]);

echo $human->name; // Bob
echo $human->age; // 42
```

Create your entity list like this :

```php
use Entities\EntityList;

class People extends EntityList
{
    protected string $expectedType = Human::class;

    public function getYoungest(): Human
    {       
        $entities = $this->entities;

        uasort($entities, function ($a, $b) {
            if ($a->age === $b->age) {
                return 0;
            }
    
            return ($a > $b) ? -1 : 1;
        });

        return array_pop($entities);
    }
}
```

Then instanciate a list like that :

```php
$bob = new Human(['name' => 'Bob', 'age' => 45]);
$junior = new Human(['name' => 'Junior', 'age' => 21]);
$jane = new Human(['name' => 'Jane', 'age' => 31]);

$people = new People([$bob, $junior]);
$people[] = $jane;

echo $people[0]->name; // Bob
echo $people[1]->name; // Junior
echo $people->getYoungest()->name; // Junior
```
