{{
  Form::bsSelect($name, 'Play',
    array_reduce($playList->toArray(), function(&$r, $play) {
      $r[$play['id']] = $play['name'];
      return $r;
    }, []), true, null, 9)
}}