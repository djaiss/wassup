## Aug 28th 2024

I've created the Laravel skeleton. I've chosen so far to use Pest and Livewire. 

I honestly wonder whether both choices are good choices. In the past, I've found that Pest was not a good choice for me, as I didn't like its syntax at all. It's almost too elegant. I know, weird. I find it harder to read than PHPUnit.

As for Livewire, I've used it in the past. It's a great library. The interactivity I have with Vue is better though. But Vue is much more complex. Also, in Vue 3 I loathe the Composition API. It makes it much harder to read too. So, on one hand we have a library that is amazing but hard to read and heavier in the browser, and on the other hand we have a library that is simpler but less powerful. Also, there are much more components available for Vue than Livewire.

At the end of the day, I want a simple system. Livewire is objectively simpler. I'll stick with it.

Fortunately, Pinkary (the project) has been released in open source. It uses Livewire extensively. I'll use it as a reference.

I've setup the inital tools needed to lint and test the code:

- PHPStan is setup. I've tried using it at the max level, but it's just impossible. Even on a fresh Laravel install, it's impossible to get it to work. I've set it to level 8 and it seems ok so far.
- I've setup Rector. I didn't know it - Pinkary gave me the idea. From what I see, it's a linter. 
- I've also setup Laravel pint. It's just great. I've copied/paste the preset from Pinkary since it's a great starting point. Also, it will force me to enforce strong typing in the code.

## Aug 29th 2024

Trying to understand the code from the Pinkary repo. I never learned how to use Gates in Laravel. I'm trying to understand if it will make my life better. So far I don't know.

Ok I've read a bit about it. It's actually interesting. I've struggled to understand the differences between gates and middlewares. There is an interesting discussion [here](https://stackoverflow.com/questions/35019292/laravel-difference-between-route-middleware-and-policy/35591736#35591736) that explains it well. One of the key point is that middlewares can make the route file super messy, and I've experienced it in the past. I'll use gates in this project.
