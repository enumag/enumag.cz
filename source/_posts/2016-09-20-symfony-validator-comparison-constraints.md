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

Interval from one date to different date
You need to compare that ending date is greater than equal than starting date.

Password check

You let the user fill the new password twice and then compare if they are the same.


Solution

The point is that Symfony actually does have an easy mechanism to do these validations. It's just not covered in the documentation very well and less experienced developers can easily miss it.

