<?php

namespace common\models;

use Yii;

class ClinicDocumentUploads extends DocumentUploads {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%clinic_document_uploads}}';
    }
}
