# Test Driven PHP

[Course](https://garyclarketech.teachable.com/courses/test-driven-php/lectures/47786004)

## Welcome to the course!

In this course we are going to build an API using test-driven development and the Pest PHP testing framework.

The goal is to be able to make a request to a URI like this /books/1

And get the correct status, headers, and a json body which looks something like this:

```json
{
  "id": 1,
  "title": "Clean Code: A Handbook of Agile Software Craftsmanship",
  "year_published": 2008,
  "available_since": "May 2023",
  "author": {
    "id": 1,
    "name": "Robert C. Martin",
    "bio": "This is an author"
  }
}
```

What is so difficult about that I hear you ask...

The complexity in this task is that we will be building the whole thing from scratch without the use of any framework...

So without all of those convenient testing tools which are available to you in Laravel and Symfony, we now have the
challenge of having to understand how they work in order to build our own...on top of writing the actual application
code 😲

You'll soon discover that frameworks do a lot of things for us that we take for granted...but you're also going to learn
a lot of stuff that other developers simply do not know...
