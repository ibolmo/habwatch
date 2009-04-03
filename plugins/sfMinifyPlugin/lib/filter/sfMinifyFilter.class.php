<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfMinifyFilter automatically adds javascripts and stylesheets information in the sfResponse content.
 *
 * @package    symfony
 * @subpackage sfMinifyPlugin
 * @author     Gordon Franke
 * @version    SVN: $Id: sfMinifyFilter.class.php 3244 2007-01-12 14:46:11Z gordon $
 */
class sfMinifyFilter extends sfFilter
{
  /**
   * Executes this filter.
   *
   * @param sfFilterChain A sfFilterChain instance
   */
  public function execute($filterChain)
  {
    // execute next filter
    $filterChain->execute();

    // execute this filter only once
    $response = $this->getContext()->getResponse();

    // include javascripts and stylesheets
    $content = $response->getContent();
    if (false !== ($pos = strpos($content, '</head>')))
    {
      sfContext::getInstance()->getConfiguration()->loadHelpers(array('Tag', 'Asset', 'SfMinify'));

      $html = '';
      if (!sfConfig::get('symfony.asset.javascripts_included', false))
      {
        $html .= minify_get_javascripts($response, $this->getParameter('javascripts', true));
      }
      if (!sfConfig::get('symfony.asset.stylesheets_included', false))
      {
        $html .= minify_get_stylesheets($response, $this->getParameter('stylesheets', true));
      }

      if ($html)
      {
        $response->setContent(substr($content, 0, $pos).$html.substr($content, $pos));
      }
    }

    sfConfig::set('symfony.asset.javascripts_included', false);
    sfConfig::set('symfony.asset.stylesheets_included', false);
  }
}
