---
title: "Symfony/Validator: How to implement comparison constraints"
categories:
    - Symfony
perex: > # multi-line string
    In Symfony/Validator there is no obvious way to implement validations like comparing a value to another property on the same object. There are several articles about this topic already but literally all of them are completely outdated. In this article I'll cover the correct way to solve this.
lang: en
---

<p class="perex">{{ page.perex|raw }}</p>

Use cases
----

- For date interval ensure that starting date is lower than ending date.
- Password confirmation value should be the same as password.


The outdated solution
----

The obvious solution is to create a custom constraint and validator. It's explained in [several](https://creativcoders.wordpress.com/2014/07/19/symfony2-two-fields-comparison-with-custom-validation-constraints/) [articles](http://www.yewchube.com/2011/08/symfony-2-field-comparison-validator/) and [StackOverflow](http://stackoverflow.com/questions/15972404/symfony2-validation-datetime-1-should-be-before-datetime-2) [questions](http://stackoverflow.com/questions/8170301/symfony2-form-validation-based-on-two-fields). Note that all of these are several years old. Other answers suggest using the Callback constraint instead.

If your application requires several different comparisons like this you end up with quite a lot of code. Way more than a simple thing like this should really require.


The correct solution
----

The point of this article is that Symfony actually does have an [easy mechanism](http://symfony.com/doc/current/reference/constraints/Expression.html) to do these validations. The Expression constraint is not something new either. It's just not covered in the documentation very well and less experienced developers can easily miss it.

The Expression constraint takes advantage of the [ExpressionLanguage](http://symfony.com/doc/current/components/expression_language.html) component. In the expression you can use the `value` and `this` placeholders to access the value itself or the underlying object respectively.


Example
----

```language-php
    /**
     * @var \DateTime
     */
    protected $startDate;

    /**
     * @var \DateTime
     * @Assert\Expression("value >= this.startDate")
     */
    protected $endDate;
```

Indeed it's this easy! And more importantly the Expression constraint can help you solve many other situations. Plus the ExpressionLanguage can be [extended](http://symfony.com/doc/current/components/expression_language/extending.html) with your own functions.
