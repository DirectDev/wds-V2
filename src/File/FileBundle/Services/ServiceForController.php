<?php

namespace File\FileBundle\Services;
use Symfony\Component\DependencyInjection\Container;

class ServiceForController
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function getEditIdAndExistingFiles($options = array())
    {
        $result = array( 'editId', 'existingFiles');
        
        if(!isset($options['entityName']))
            return $result;
            
        $entityName = $options['entityName'];
        $entityId = $options['entityId'];
        $editId = $options['editId'];
        if (!preg_match('/^\d+$/', $editId))
        {
            $editId = sprintf('%09d', mt_rand(0, 1999999999));
            if ($entityId)
            {
                /* get existing files */
//                $this->container->get('punk_ave.file_uploader')->syncFiles(
//                    array(
//                    'from_folder' => $entityName.'/' . $entityId,
//                    'to_folder' => $this->container->getParameter('upload_folder') . $editId,
//                    'create_to_folder' => true));
            }
        }
        
        
        $existingFiles = $this->container->get('punk_ave.file_uploader')->getFiles(
                array('folder' => $this->container->getParameter('upload_folder') . $editId));
        
        $this->container->get('punk_ave.file_uploader')->syncFiles(
            array(
            'from_folder' => $this->container->getParameter('upload_folder') . $editId,
            'to_folder' => $entityName.'/' . $entityId,
            'remove_from_folder' => false,
            'create_to_folder' => true
                )
        );
        
        
        $result['editId'] = $editId;
        $result['existingFiles'] = $existingFiles;
        
        return $result;
        
    }

}
