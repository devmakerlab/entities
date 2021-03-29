# DevMakerLab - Entities

[![Run tests](https://github.com/devmakerlab/entities/workflows/Run%20tests/badge.svg)](https://github.com/devmakerlab/entities/actions)
[![Code Coverage](https://scrutinizer-ci.com/g/devmakerlab/entities/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/devmakerlab/entities/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/devmakerlab/entities/v/stable)](https://packagist.org/packages/devmakerlab/entities)

This package provide a way to implements entities. Useful for your services or repositories.

## Usage

Create your entity in dedicated class :

```php
use DevMakerLab\Entity;

class Human extends Entity
{
    public string $name;
    public int $age;
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
use DevMakerLab\EntityList;

class People extends EntityList
{
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
