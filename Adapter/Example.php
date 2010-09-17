<?php
/**
 * @copyright © 2010, Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

require_once 'Scripto/Adapter/Interface.php';

/**
 * An example adapter for a hypothetical CMS.
 * 
 * @see Scripto_Adapter_Interface
 */
class Scripto_Adapter_Example implements Scripto_Adapter_Interface
{
    /**
     * Example document data.
     * 
     * For example purposes the document data are stored following this format:
     * 
     * {documentId} => array(
     *     {pageId} => array(
     *         'page_name' => {pageName}, 
     *         'page_image_url' => {pageImageUrl}
     *     )
     * ) 
     * 
     * Other adapters will likely get relevant data using the CMS API, and not 
     * hardcode them like this example. Be sure to URL encode the document and 
     * page IDs when transporting over HTTP. For example:
     * 
     * documentId: Request for Purchase of Liver Oil & Drum Heads
     * pageId: xbe/XBE02001.jpg
     * ?documentId=Request+for+Purchase+of+Liver+Oil+%26+Drum+Heads&pageId=xbe%2FXBE02001.jpg
     * 
     * These example documents are from CHNM's Papers of the War Department.
     * 
     * @var array
     */
    private $_documents = array(
        // Example of the preferred way to set the document and page IDs using 
        // unique keys.
        // See: http://wardepartmentpapers.org/document.php?id=16344
        16344 => array(
            67799 => array(
                'page_name' => 'Letter Outside', 
                'page_image_url' => 'http://wardepartmentpapers.org/images/medium/zto/ZTO07001.jpg'
            ), 
            67800 => array(
                'page_name' => 'Letter Body', 
                'page_image_url' => 'http://wardepartmentpapers.org/images/medium/zto/ZTO07002.jpg'
            ), 
            67801 => array(
                'page_name' => 'Worksheet 1, Outside', 
                'page_image_url' => 'http://wardepartmentpapers.org/images/medium/zto/ZTO07003.jpg'
            ), 
            67802 => array(
                'page_name' => 'Worksheet 1, Page 1', 
                'page_image_url' => 'http://wardepartmentpapers.org/images/medium/zto/ZTO07004.jpg'
            ), 
            67803 => array(
                'page_name' => 'Worksheet 1, Page 2', 
                'page_image_url' => 'http://wardepartmentpapers.org/images/medium/zto/ZTO07005.jpg'
            ), 
            67804 => array(
                'page_name' => 'Worksheet 2, Outside', 
                'page_image_url' => 'http://wardepartmentpapers.org/images/medium/zto/ZTO07006.jpg'
            ), 
            67805 => array(
                'page_name' => 'Worksheet 2, Page 1', 
                'page_image_url' => 'http://wardepartmentpapers.org/images/medium/zto/ZTO07007.jpg'
            )
        ), 
        // Alternate way to set document and page IDs using all possible 
        // characters.
        // See: http://wardepartmentpapers.org/document.php?id=41827
        'Request for Purchase of Liver Oil & Drum Heads' => array( // document ID
            'xbe/XBE02001.jpg' => array( // page ID
                'page_name' => '1', 
                'page_image_url' => 'http://wardepartmentpapers.org/images/medium/xbe/XBE02001.jpg'
            ), 
            // page ID
            'xbe/XBE02002.jpg' => array( // page ID
                'page_name' => '2', 
                'page_image_url' => 'http://wardepartmentpapers.org/images/medium/xbe/XBE02002.jpg'
            )
        )
    );
    
    public function documentExists($documentId)
    {
        return array_key_exists($documentId, $this->_documents);
    }
    
    public function documentPageExists($documentId, $pageId)
    {
        return array_key_exists($pageId, $this->_documents[$documentId]);
    }
    
    public function getDocumentPages($documentId)
    {
        $pages = array();
        foreach ($this->_documents[$documentId] as $pageId => $page) {
            $pages[$pageId] = $page['page_name'];
        }
        return $pages;
    }
    
    public function getDocumentPageImageUrl($documentId, $pageId)
    {
        return $this->_documents[$documentId][$pageId]['page_image_url'];
    }
    
    public function importDocumentPageTranscription($documentId, $pageId, $text)
    {
        return false;
    }
    
    public function importDocumentTranscription($documentId, $text)
    {
        return false;
    }
}