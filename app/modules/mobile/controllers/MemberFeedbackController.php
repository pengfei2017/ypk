<?php
/**
 * 我的反馈
 */

namespace Ypk\Modules\Mobile\Controllers;



class MemberFeedbackController extends MobileMemberController {

    public function initialize() {
        parent::initialize();
    }

    /**
     * 添加反馈
     */
    public function feedback_addAction() {
        $model_mb_feedback = Model('mb_feedback');

        $param = array();
        $param['content'] = $_POST['feedback'];
        $param['type'] = $this->member_info['client_type'];
        $param['ftime'] = TIMESTAMP;
        $param['member_id'] = $this->member_info['member_id'];
        $param['member_name'] = $this->member_info['member_name'];

        $result = $model_mb_feedback->addMbFeedback($param);

        if($result) {
            output_data('1');
        } else {
            output_error('保存失败');
        }
    }
}
