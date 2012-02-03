<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dkreuer
 * Date: 03.02.12
 * Time: 17:41
 * To change this template use File | Settings | File Templates.
 */
class Zend_View_Helper_Less extends Zend_View_Helper_Abstract
{
    protected $_lessLoaded = false;

    public function less($cssFileName, $media = 'screen')
    {
        $fullCssFileName = getcwd() . '/' . $cssFileName;
        if (file_exists($fullCssFileName))
        {
            $this->view->headLink()->appendStylesheet($cssFileName, $media);
            return $this;
        }
        $lessFileName = mb_substr($cssFileName, 0, -4) . '.less';
        $fullLessFileName = getcwd() . '/' . $lessFileName;
        if (file_exists($fullLessFileName))
        {
            if (!$this->_lessLoaded)
            {
                $this->view->headScript()->prependFile('lib/less-1.2.1.min.js');
                $this->_lessLoaded = true;
            }
            $this->view->headLink(array(
                'rel' => 'stylesheet/less',
                'href' => $lessFileName,
                'media' => $media,
            ), 'APPEND');
            return $this;
        }
    }

    public function __toString()
    {
        return '';
    }
}
