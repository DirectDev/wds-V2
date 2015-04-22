<?php

namespace File\FileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UploadController extends Controller {

    public function uploadAction() {
        $editId = $this->getRequest()->get('editId');
        if (!preg_match('/^\d+$/', $editId)) {
            throw new Exception("Bad edit id");
        }

        $this->get('punk_ave.file_uploader')->handleFileUpload(
                array(
                    'folder' => $this->container->getParameter('upload_folder') . $editId,
                    'web_base_path' =>  $this->getRequest()->getBasePath().$this->container->getParameter('upload_web_base_path')
                    )
                );
    }

}
