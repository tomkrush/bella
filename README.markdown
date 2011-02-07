# Bella

Bella is a PHP project inspired by [Arel](http://github.com/rails/arel). Bella has the same internal structure as Arel and has a very similar syntax to it as well. Check [bella.tomkrush.com](http://bella.tomkrush.com) to see the tests perform.

## Installation

1. Clone *https://github.com/tomkrush/bella*
2. Make sure bella is visible on server and target index.php for the unit tests.
3. So far I can confirm that Bella runs on at least PHP 5.2.13.

## Examples

The best place to check out examples is in the unit tests (bella/tests).

### Simple Query

	$users = new Table('users');
	echo  $users->project('*')->to_sql();

	// Result: SELECT * FROM users

	$users = new Table('users');
	$query = $users->where($users['name']->eq('bob')->otherwise($users['age']->lt(25)));

// Result: SELECT FROM users WHERE (name = 'bob' OR age < 25)

### Keyword Conflicts

I had to rename to methods 'and' to 'also' and 'or' to 'otherwise'. This decision was made because PHP uses both keywords 'or' and 'and'.

If anyone finds words to better describe these methods message me.