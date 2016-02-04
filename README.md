# symfony-control

[![Build Status](https://travis-ci.org/tmilos/symfony-control.svg?branch=master)](https://travis-ci.org/tmilos/symfony-control)

Symfony bundle implementing the Twig control tag. Easy rendering of blocks with ability to pass specified parameters trough
new ``control`` twig tag.


## Installation

Require ``tmilos/symfony-control`` with composer

``` bash
require tmilos/symfony-control
```

Add the bundle to your AppKernel

``` php
class AppKernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Tmilos\ControlBundle\TmilosShipControlBundle(),
            // ...
        );
    }
}
```


## Control twig tag

``` twig
{% control BLOCK_NAME with EXPRESSION %}
```

It will display specified BLOCK_NAME with specified EXPRESSION put as the value of the ``control`` variable available only in
that block scope.



## property twig function

``` twig
{{ property(object, 'path.to.property') }}
```

Returns value of the object's property

Wrapper around ``Symfony\Component\PropertyAccess\PropertyAccessor::getValue()``



## has_property twig function

``` twig
{{ has_property(object, 'path.to.property') }}
```

Returns bool

Wrapper around ``Symfony\Component\PropertyAccess\PropertyAccessor::isReadable()``



## Usage Example

``` twig
{# table.html.twig #}

{% block table %}
    <table>
        <tr>
        {% for col in control.columns %}
            <th>{{ col|trans }}</th>
        {% endfor
        </tr>
        {% for row in control.rows %}
        <tr>
            {% for col in control.columns %}
            <td>
                {{ has_property(row, col) ? property(row, col) : block(col) }}
            </td>
            {% endfor %}
        </tr>
        {% endfor
    </table>
{% endblock %}
```

``` twig
{# index.html.twig #}

{% extends 'base.html.twig' %}

{% use 'table.html.twig' %}

{% block body %}
    {% control table with {
        columns: ['name', 'user.email', 'special_column'],
        rows: entities
    } %}
{% endblock %}

{% block special_column %}
    <a href="{{ path('foo', {id: row.id}) }}">edit</a>
{% endblock %}
```

