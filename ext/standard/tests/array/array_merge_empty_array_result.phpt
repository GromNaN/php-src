--TEST--
array_merge() with an empty argument returns an array with a fresh next free index and internal pointer
--FILE--
<?php
// array_merge() with an empty argument returns the other argument itself. The
// result must still behave like a fresh array: integer keys renumbered from 0,
// next free index reset and internal pointer on the first element.

$a = [1, 2, 3];
unset($a[2]);
$r = array_merge($a, []);
$r[] = 4;
var_dump($r);

$b = ['a' => 1];
$b[] = 2;
unset($b[0]);
$r = array_merge([], $b);
$r[] = 3;
var_dump($r);

$c = [10, 20, 30];
next($c);
next($c);
var_dump(current(array_merge([], $c)));
?>
--EXPECT--
array(3) {
  [0]=>
  int(1)
  [1]=>
  int(2)
  [2]=>
  int(4)
}
array(2) {
  ["a"]=>
  int(1)
  [0]=>
  int(3)
}
int(10)
