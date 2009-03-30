<?php

/**
 * PHP Geometry/WKT encoder/decoder
 *
 * @package GeoJSON
 *
 * @author Camptocamp <info@camptocamp.com>
 *
 */
class WKT
{

  /**
   * Loads a WKT string into a Geometry Object
   *
   * @param string $WKT
   *
   * @return  Geometry
   */
  static public function load($WKT)
  {
    // TODO
    $matches = array();
    if (preg_match('/^POINT\((-?\d+(?:\.\d+)?) (-?\d+(?:\.\d+)?)\)$/', $WKT, $matches))
    {
      return new Point($matches[1], $matches[2]);
    }
    return new LineString(array(new Point(0, 0), new Point(0, 10), new Point(10, 10), new Point(10, 0)));
  }

  /**
   * Dumps a Geometry Object into a  WKT string
   *
   * @param Geometry $geometry
   *
   * @return String A WKT string corresponding to passed object
   */
  static public function dump(Geometry $geometry)
  {
    // TODO
    return 'LINESTRING(905529.176838753 80934.9861125366,905253.985811447 80952.2857982665,905156.030637281 80163.0305996348,904210.390862349 79519.3906365179,904312.01219508 81144.0717182127,904182.321835833 81980.1850060069,903962.696024282 82130.9557770041,903960.060972813 83649.8910975816,904468.16763647 83488.4655532541,904592.473325324 83933.6746840253,905055.554979101 84145.2807737151,904849.104424894 84999.953989246,906367.925178016 86817.9103678042,907586.120928785 86022.2393916833,907829.11850119 86189.393308769,907731.50702939 85176.8461400207,907115.592390423 85074.4228351032,907259.71824902 84762.4556546889,906779.451476969 84107.5880809658,906362.655075078 83946.9645088245,906314.99501373 83439.4306824435,906629.940947978 83147.0545368624,906547.91065008 82310.9412490683,905529.176838753 80934.9861125366)';
  }

}
