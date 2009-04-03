<?php
/**
 * Return one <script> tag for all javascripts configured in view.yml or added to the response object.
 *
 * You can use this helper to decide the location of javascripts in pages.
 * By default, if you don't call this helper, symfony will automatically include javascripts before </head>.
 * Calling this helper disables this behavior.
 *
 * @return string <script> tag
 */
function minify_get_javascripts($response = null, $minify = true)
{
    if (!$response) $response = sfContext::getInstance()->getResponse();
  if(!$minify) return get_javascripts();

  sfConfig::set('symfony.asset.javascripts_included', true);

  $already_seen = array();
  $minify_files = array();
  foreach ($response->getPositions() as $position)
  {
    foreach ($response->getJavascripts($position) as $files => $options)
    {
      if (!is_array($files))
      {
        $files = array($files);
      }

      $options = array_merge(array('type' => 'text/javascript'));
      foreach ($files as $file)
      {
        if (isset($already_seen[$file])) continue;

        $already_seen[$file] = 1;

        $file = javascript_path($file);
        $type = serialize($options);

        if(isset($minify_files[$type]))
        {
          array_push($minify_files[$type], $file);
        }
        else
        {
          $minify_files[$type] = array($file);
        }
      }
    }
  }

  $html = '';
  foreach($minify_files as $options => $files)
  {
    $options = unserialize($options);
    $options['src'] = join($files, ',');
    $html   .= content_tag('script', '', $options)."\n";
  }

  return $html;
}

/**
 * Print <script> tag for all javascripts configured in view.yml or added to the response object.
 *
 * @see minify_get_javascripts()
 */
function minify_include_javascripts()
{
  echo minify_get_javascripts();
}

/**
 * Return one <link> tag for all stylesheets configured in view.yml or added to the response object.
 *
 * You can use this helper to decide the location of stylesheets in pages.
 * By default, if you don't call this helper, symfony will automatically include stylesheets before </head>.
 * Calling this helper disables this behavior.
 *
 * @return string <link> tags
 */
function minify_get_stylesheets($response = null, $minify = true)
{
    if (!$response) $response = sfContext::getInstance()->getResponse();
  if(!$minify) return get_stylesheets();

  sfConfig::set('symfony.asset.stylesheets_included', true);

  $already_seen = array();
  $minify_files = array();
  foreach ($response->getPositions() as $position)
  {
    foreach ($response->getStylesheets($position) as $files => $options)
    {
      if (!is_array($files))
      {
        $files = array($files);
      }

      $options = array_merge(array('rel' => 'stylesheet', 'type' => 'text/css', 'media' => 'screen'), $options);
      foreach ($files as $file)
      {
        if (isset($already_seen[$file])) continue;

        $already_seen[$file] = 1;

        $absolute = false;
        if (isset($options['absolute']))
        {
          unset($options['absolute']);
          $absolute = true;
        }

        if(!isset($options['raw_name']))
        {
          $file = stylesheet_path($file, $absolute);
        }
        else
        {
          unset($options['raw_name']);
        }

        $type = serialize($options);

        if(isset($minify_files[$type]))
        {
          array_push($minify_files[$type], $file);
        }
        else
        {
          $minify_files[$type] = array($file);
        }
      }
    }
  }

  $html = '';
  foreach($minify_files as $options => $files)
  {
    $options = unserialize($options);
    $options['href'] = join($files, ',');
    $html .= tag('link', $options)."\n";
  }

  return $html;
}

/**
 * Print <link> tag for all stylesheets configured in view.yml or added to the response object.
 *
 * @see minify_get_stylesheets()
 */
function minify_include_stylesheets()
{
  echo minify_get_stylesheets();
}
