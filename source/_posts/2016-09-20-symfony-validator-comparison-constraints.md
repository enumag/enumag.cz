---
title: "Symfony/Validator (1/3): Comparison constraints"
categories:
    - Symfony
perex: > # multi-line string
    In Symfony/Validator there is no obvious way to implement validations like comparing a value to another property on the same object. There are several articles about this topic already but literally all of them are completely outdated. In this article I'll cover the correct way to solve this.
thumbnail: symfony.png
lang: en
---

<p class="perex">{{ page.perex|raw }}</p>

Use cases
----

- For date interval ensure that starting date is lower than ending date.
- Password confirmation value should be the same as password.

```language-php
use Symfony\Component\Validator\Constraints as Assert;

class Event
{
    /**
     * @var \DateTime
     * @Assert\Type("DateTime")
     */
    protected $startDate;

    /**
     * @todo Add validator constraint that end date cannot be lower than start date.
     * @var \DateTime
     * @Assert\Type("DateTime")
     */
    protected $endDate;
}
```

The outdated solution
----

The obvious solution is to create a custom constraint and validator. It's explained in [several](https://creativcoders.wordpress.com/2014/07/19/symfony2-two-fields-comparison-with-custom-validation-constraints/) [articles](http://www.yewchube.com/2011/08/symfony-2-field-comparison-validator/) and [StackOverflow](http://stackoverflow.com/questions/15972404/symfony2-validation-datetime-1-should-be-before-datetime-2) [questions](http://stackoverflow.com/questions/8170301/symfony2-form-validation-based-on-two-fields). Note that all of these are several years old. And you might easily end up with a lot of custom constraints. Other answers suggest using the Callback constraint instead.

The correct solution
----

The point of this article is that Symfony actually does have an [easy mechanism](http://symfony.com/doc/current/reference/constraints/Expression.html) to do these validations. The Expression constraint is not something new either. It's just not covered in the documentation very well and less experienced developers can easily miss it.

The Expression constraint takes advantage of the [ExpressionLanguage](http://symfony.com/doc/current/components/expression_language.html) component. In the expression you can use the `value` and `this` placeholders to access the value itself or the underlying object respectively.


Example
----

```language-php
use Symfony\Component\Validator\Constraints as Assert;

class Event
{
    /**
     * @var \DateTime
     * @Assert\Type("DateTime")
     */
    protected $startDate;

    /**
     * @var \DateTime
     * @Assert\Type("DateTime")
     * @Assert\Expression("value >= this.startDate")
     */
    protected $endDate;
}
```

Indeed it's this easy! More importantly the Expression constraint can help you solve many other situations. Plus the ExpressionLanguage can be [extended](http://symfony.com/doc/current/components/expression_language/extending.html) with your own functions.


Usage with Nette Framework
----

If you want to use the Symfony/Validator component and the Expression constraint in your Nette application you will need these libraries:

- [Kdyby/Validator](https://github.com/Kdyby/Validator)
- [Arachne/ExpressionLanguage](https://github.com/Arachne/ExpressionLanguage)
- [Arachne/Doctrine](https://github.com/Arachne/Doctrine) (optional, enables caching for the ExpressionLanguage parser)
