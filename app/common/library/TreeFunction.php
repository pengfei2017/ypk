<?php
/**
 * 操作树函数
 *
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/11/17
 * Time: 10:10
 */

/**
 * hpf
 *
 * 得到当前节点的直接父节点的tree_id
 * @param int $tree_id
 * @return bool|int
 */
function get_one_parent($tree_id)
{
    if ($tree_id <= 1) {
        //如果是1，就是平台，返回false
        return false;
    }

    if ($tree_id % 2 != 0) {
        //如果当前节点是奇数
        $tree_id = $tree_id - 1;
    }
    return $tree_id / 2;
}

/**
 * hpf
 *
 * 得到客户树当前节点和他下面的所有左右子树上的子节点的member集合
 *
 * @param int $member_tree_id 默认值是1，平台的
 * @param null $row 相对指定节点所在的行向下查找几代
 * @param string $column 要查询的字段
 * @return array
 */
function get_whole_member_tree($member_tree_id = 1, $row = null, $column = '*')
{
    if ($member_tree_id >= 1) {
        if (empty($row)) {
            $max_member_tree_row = \Ypk\Models\Member::maximum(array('column' => 'member_tree_row'));
        } else {
            $self_row = get_tree_row($member_tree_id);
            if ($self_row === false) {
                return array();
            } else {
                $max_member_tree_row = $self_row + $row;
            }
        }
        $whole_member_tree_index[] = $member_tree_id;
        $whole_tree_child_ids = get_whole_tree_child_ids($member_tree_id, $max_member_tree_row);
        if (!empty($whole_tree_child_ids)) {
            $whole_member_tree_index = array_merge($whole_member_tree_index, $whole_tree_child_ids);
            sort($whole_member_tree_index);
        }
        $members = \Ypk\Models\Member::find(array('member_tree_id in (' . implode(',', $whole_member_tree_index) . ')', 'columns' => $column));
        if (count($members) > 0) {
            $members = $members->toArray();
        } else {
            $members = array();
        }

        $whole_member_tree = array();
        foreach ($members as $member) {
            $whole_member_tree[$member['member_tree_id']] = $member;
        }
        ksort($whole_member_tree);
        return $whole_member_tree;
    } else {
        return array();
    }
}

/**
 * hpf
 *
 * 得到客户树当前节点下面所有左树上的子节点的tree_id
 *
 * @param int $member_tree_id 默认值是1，平台的
 * @param null $row 相对指定节点所在的行向下查找几代
 * @param string $column 要查询的字段
 * @return array
 */
function get_left_member_tree_childs($member_tree_id = 1, $row = null, $column = '*')
{
    if ($member_tree_id >= 1) {
        if (empty($row)) {
            $max_member_tree_row = \Ypk\Models\Member::maximum(array('column' => 'member_tree_row'));
        } else {
            $self_row = get_tree_row($member_tree_id);
            if ($self_row === false) {
                return array();
            } else {
                $max_member_tree_row = $self_row + $row;
            }
        }

        $left_member_tree_index = get_left_tree_child_ids($member_tree_id, $max_member_tree_row);
        if (empty($left_member_tree_index)) {
            return array();
        }
        $members = \Ypk\Models\Member::find(array('member_tree_id in (' . implode(',', $left_member_tree_index) . ')', 'columns' => $column));
        if (count($members) > 0) {
            $members = $members->toArray();
        } else {
            $members = array();
        }

        $left_member_tree_childs = array();
        foreach ($members as $member) {
            $left_member_tree_childs[$member['member_tree_id']] = $member;
        }
        ksort($left_member_tree_childs);
        return $left_member_tree_childs;
    } else {
        return array();
    }
}

/**
 * hpf
 *
 * 得到客户树当前节点下面所有右树上的子节点的tree_id
 *
 * @param int $member_tree_id 默认值是1，平台的
 * @param null $row 相对指定节点所在的行向下查找几代
 * @param string $column 要查询的字段
 * @return array
 */
function get_right_member_tree_childs($member_tree_id = 1, $row = null, $column = '*')
{
    if ($member_tree_id >= 1) {
        if (empty($row)) {
            $max_member_tree_row = \Ypk\Models\Member::maximum(array('column' => 'member_tree_row'));
        } else {
            $self_row = get_tree_row($member_tree_id);
            if ($self_row === false) {
                return array();
            } else {
                $max_member_tree_row = $self_row + $row;
            }
        }

        $right_member_tree_index = get_right_tree_child_ids($member_tree_id, $max_member_tree_row);
        if (empty($right_member_tree_index)) {
            return array();
        }
        $members = \Ypk\Models\Member::find(array('member_tree_id in (' . implode(',', $right_member_tree_index) . ')', 'columns' => $column));
        if (count($members) > 0) {
            $members = $members->toArray();
        } else {
            $members = array();
        }

        $right_member_tree_childs = array();
        foreach ($members as $member) {
            $right_member_tree_childs[$member['member_tree_id']] = $member;
        }
        ksort($right_member_tree_childs);
        return $right_member_tree_childs;
    } else {
        return array();
    }
}

/**
 * hpf
 *
 * 得到医护人员树当前节点和他下面的所有左右子树上的子节点的member集合
 *
 * @param int $store_tree_id 默认值是1，平台的
 * @param null $row 相对指定节点所在的行向下查找几代
 * @param string $column 要查询的字段
 * @return array
 */
function get_whole_store_tree($store_tree_id = 1, $row = null, $column = '*')
{
    if ($store_tree_id >= 1) {
        if (empty($row)) {
            $max_store_tree_row = \Ypk\Models\Member::maximum(array('column' => 'store_tree_row'));
        } else {
            $self_row = get_tree_row($store_tree_id);
            if ($self_row === false) {
                return array();
            } else {
                $max_store_tree_row = $self_row + $row;
            }
        }

        $whole_store_tree_index[] = $store_tree_id;
        $whole_tree_child_ids = get_whole_tree_child_ids($store_tree_id, $max_store_tree_row);
        if (!empty($whole_tree_child_ids)) {
            $whole_store_tree_index = array_merge($whole_store_tree_index, $whole_tree_child_ids);
            sort($whole_store_tree_index);
        }
        $members = \Ypk\Models\Member::find(array('store_tree_id in (' . implode(',', $whole_store_tree_index) . ')', 'columns' => $column));
        if (count($members) > 0) {
            $members = $members->toArray();
        } else {
            $members = array();
        }

        $whole_store_tree = array();
        foreach ($members as $member) {
            $whole_store_tree[$member['store_tree_id']] = $member;
        }
        ksort($whole_store_tree);
        return $whole_store_tree;
    } else {
        return array();
    }
}

/**
 * hpf
 *
 * 得到医护人员树当前节点下面所有左树上的子节点的tree_id
 *
 * @param int $store_tree_id 默认值是1，平台的
 * @param null $row 相对指定节点所在的行向下查找几代
 * @param string $column 要查询的字段
 * @return array
 */
function get_left_store_tree_childs($store_tree_id = 1, $row = null, $column = '*')
{
    if ($store_tree_id >= 1) {
        if (empty($row)) {
            $max_store_tree_row = \Ypk\Models\Member::maximum(array('column' => 'store_tree_row'));
        } else {
            $self_row = get_tree_row($store_tree_id);
            if ($self_row === false) {
                return array();
            } else {
                $max_store_tree_row = $self_row + $row;
            }
        }

        $left_store_tree_index = get_left_tree_child_ids($store_tree_id, $max_store_tree_row);
        if (empty($left_store_tree_index)) {
            return array();
        }
        $members = \Ypk\Models\Member::find(array('store_tree_id in (' . implode(',', $left_store_tree_index) . ')', 'columns' => $column));
        if (count($members) > 0) {
            $members = $members->toArray();
        } else {
            $members = array();
        }

        $left_store_tree_childs = array();
        foreach ($members as $member) {
            $left_store_tree_childs[$member['store_tree_id']] = $member;
        }
        ksort($left_store_tree_childs);
        return $left_store_tree_childs;
    } else {
        return array();
    }
}

/**
 * hpf
 *
 * 得到医护人员树当前节点下面所有右树上的子节点的tree_id
 *
 * @param int $store_tree_id 默认值是1，平台的
 * @param null $row 相对指定节点所在的行向下查找几代
 * @param string $column 要查询的字段
 * @return array
 */
function get_right_store_tree_childs($store_tree_id = 1, $row = null, $column = '*')
{
    if ($store_tree_id >= 1) {
        if (empty($row)) {
            $max_store_tree_row = \Ypk\Models\Member::maximum(array('column' => 'store_tree_row'));
        } else {
            $self_row = get_tree_row($store_tree_id);
            if ($self_row === false) {
                return array();
            } else {
                $max_store_tree_row = $self_row + $row;
            }
        }

        $right_store_tree_index = get_right_tree_child_ids($store_tree_id, $max_store_tree_row);
        if (empty($right_store_tree_index)) {
            return array();
        }
        $members = \Ypk\Models\Member::find(array('store_tree_id in (' . implode(',', $right_store_tree_index) . ')', 'columns' => $column));
        if (count($members) > 0) {
            $members = $members->toArray();
        } else {
            $members = array();
        }

        $right_store_tree_childs = array();
        foreach ($members as $member) {
            $right_store_tree_childs[$member['store_tree_id']] = $member;
        }
        ksort($right_store_tree_childs);
        return $right_store_tree_childs;
    } else {
        return array();
    }
}

/**
 * hpf
 *
 * 得到一个节点下面到某行的所有左树子节点的索引
 *
 * @param int $tree_id 默认值是1，平台的
 * @param int $max_tree_row
 * @return array
 */
function get_left_tree_child_ids($tree_id = 1, $max_tree_row = 0)
{
    if ($tree_id >= 1) {
        $left_member_tree_index = array();
        $left_member_tree_index[] = get_left_child($tree_id);
        $whole_tree_child_ids = get_whole_tree_child_ids($left_member_tree_index[0], $max_tree_row);
        $left_member_tree_index = array_merge($left_member_tree_index, $whole_tree_child_ids);
        if (count($left_member_tree_index) > 0) {
            sort($left_member_tree_index);
        }
        return $left_member_tree_index;
    } else {
        return array();
    }
}

/**
 * hpf
 *
 * 得到一个节点下面到某行的所有右树子节点的索引
 *
 * @param int $tree_id 默认值是1，平台的
 * @param int $max_tree_row
 * @return array
 */
function get_right_tree_child_ids($tree_id = 1, $max_tree_row = 0)
{
    if ($tree_id >= 1) {
        $right_member_tree_index = array();
        $right_member_tree_index[] = get_right_child($tree_id);
        $whole_tree_child_ids = get_whole_tree_child_ids($right_member_tree_index[0], $max_tree_row);
        $right_member_tree_index = array_merge($right_member_tree_index, $whole_tree_child_ids);
        if (count($right_member_tree_index) > 0) {
            sort($right_member_tree_index);
        }
        return $right_member_tree_index;
    } else {
        return array();
    }
}

/**
 * hpf
 *
 * 得到一个节点下面到某行的所有子节点的索引（返回的是树位置id集合）
 *
 * @param int $tree_id 默认值是1，平台的
 * @param int $max_tree_row
 * @return array
 */
function get_whole_tree_child_ids($tree_id = 1, $max_tree_row = 0)
{
    if ($tree_id >= 1) {
        $childs = array();
        $curr_row = get_tree_row($tree_id);
        if ($curr_row > $max_tree_row) {
            return array();
        }

        $left_child = get_left_child($tree_id);
        $curr_left_row = get_tree_row($left_child);
        if ($curr_left_row > $max_tree_row) {
            return array();
        }
        $childs[] = $left_child;
        $childs = array_merge($childs, get_whole_tree_child_ids($left_child, $max_tree_row));

        $right_child = get_right_child($tree_id);
        $curr_right_row = get_tree_row($right_child);
        if ($curr_right_row > $max_tree_row) {
            return array();
        }
        $childs[] = $right_child;
        $childs = array_merge($childs, get_whole_tree_child_ids($right_child, $max_tree_row));

        if (count($childs) > 0) {
            sort($childs);
        }
        return $childs;

    } else {
        return array();
    }
}

/**
 * hpf
 *
 * 得到当前节点下面左边的子节点的tree_id
 *
 * @param int $tree_id
 * @return int
 */
function get_left_child($tree_id)
{
    if ($tree_id >= 1) {
        return $tree_id * 2;
    } else {
        return false;
    }
}

/**
 * hpf
 *
 * 得到当前节点下面右边的子节点的tree_id
 *
 * @param int $tree_id
 * @return int
 */
function get_right_child($tree_id)
{
    if ($tree_id >= 1) {
        return $tree_id * 2 + 1;
    } else {
        return false;
    }
}

/**
 * hpf
 *
 * 得到某个$tree_id所在的行数 行数从0开始
 *
 * @param $tree_id
 * @return int
 */
function get_tree_row($tree_id)
{
    if ($tree_id >= 1) {
        return floor(log($tree_id, 2));
    } else {
        return false;
    }
}

/**
 * hpf
 *
 * 得到某个$tree_id所在的列数 列数从0开始
 *
 * @param $tree_id
 * @return int
 */
function get_tree_column($tree_id)
{
    if ($tree_id >= 1) {
        $row = floor(log($tree_id, 2));
        return $tree_id - pow(2, $row);
    } else {
        return false;
    }
}

/**
 * hpf
 *
 * 得到处于某行某列的节点的tree_id
 *
 * @param int $tree_row 行
 * @param  int $tree_column 列
 * @return int
 */
function get_tree_id($tree_row, $tree_column)
{
    return pow(2, $tree_row) + $tree_column;
}

/**
 * hpf
 *
 * 给新注册会员创建一个新的插入点
 *
 * @param int $inviter_id 推荐人id，默认是1（平台），如果推荐人为空，推荐人就是平台
 * @param int $member_type_id 新注册会员的会员类型，默认是1（客户树）
 * @return array
 */
function create_tree_id($inviter_id = 1, $member_type_id = 1)
{
    //找到推荐人
    $inviter = \Ypk\Models\Member::findFirst('member_id = ' . $inviter_id);

    //找到推荐人的member_tree_id
    $inviter_member_tree_id = $inviter->getMemberTreeId();

    $new_member_tree_id = $inviter_member_tree_id;

    //判断该推荐人在自己的子树中左右两边的人数
    if ($inviter->getMemberTreeLeftInviteCount() <= $inviter->getMemberTreeRightInviteCount()) {
        //把新节点放在左边子树
        $left_member_tree_childs = get_left_member_tree_childs($inviter_member_tree_id);
        while (true) {
            $new_member_tree_id = get_left_child($new_member_tree_id);
            if (empty($left_member_tree_childs[$new_member_tree_id])) {
                break;
            }
        }
    } else {
        //把新节点放在右边子树
        $right_member_tree_childs = get_right_member_tree_childs($inviter_member_tree_id);
        while (true) {
            $new_member_tree_id = get_right_child($new_member_tree_id);
            if (empty($right_member_tree_childs[$new_member_tree_id])) {
                break;
            }
        }
    }

    $tree_info['member_tree_id'] = $new_member_tree_id;
    $tree_info['member_tree_row'] = get_tree_row($new_member_tree_id);
    $tree_info['member_tree_column'] = get_tree_column($new_member_tree_id);

    if ($member_type_id != 1) {
        //如果是注册的医护人员，还得在医护人员树中寻找位置

        //如果推荐人不是医护人员，要将该新注册的医护人员归属为平台
        if ($inviter->getMemberTypeId() == 1) {
            //找到平台
            $inviter = \Ypk\Models\Member::findFirst('member_id = ' . pow(2, 0));
        }

        //找到推荐人的store_tree_id
        $inviter_store_tree_id = $inviter->getStoreTreeId();

        $new_store_tree_id = $inviter_store_tree_id;

        //判断该推荐人在自己的子树中左右两边的人数
        if ($inviter->getStoreTreeLeftInviteCount() <= $inviter->getStoreTreeRightInviteCount()) {
            //把新节点放在左边子树
            $left_store_tree_childs = get_left_store_tree_childs($inviter_store_tree_id);
            while (true) {
                $new_store_tree_id = get_left_child($new_store_tree_id);
                if (empty($left_store_tree_childs[$new_store_tree_id])) {
                    break;
                }
            }
        } else {
            //把新节点放在右边子树
            $right_store_tree_childs = get_right_store_tree_childs($inviter_store_tree_id);
            while (true) {
                $new_store_tree_id = get_right_child($new_store_tree_id);
                if (empty($right_store_tree_childs[$new_store_tree_id])) {
                    break;
                }
            }
        }

        $tree_info['store_tree_id'] = $new_store_tree_id;
        $tree_info['store_tree_row'] = get_tree_row($new_store_tree_id);
        $tree_info['store_tree_column'] = get_tree_column($new_store_tree_id);

    }

    return $tree_info;
}

/**
 * hpf
 *
 * 创建会员在客户树和医护人员树中的树节点信息 并且更新推荐人的左树或者右树的推荐人数
 *
 * 此方法加入队列执行
 *
 * @param int $member_id
 * @return array
 */
function create_member_tree_info($member_id)
{
    $member = \Ypk\Models\Member::findFirst('member_id = ' . $member_id);
    if ($member === false) {
        return queue_callback(false, "member_id = {$member_id} 的会员不存在");
    }
    $inviter_id = $member->getInviterId();
    if (is_null($inviter_id)) {
        $inviter_id = 1;
    }
    $member_type_id = $member->getMemberTypeId();
    if (is_null($member_type_id)) {
        $member_type_id = 1;
    }
    $tree_info = create_tree_id($inviter_id, $member_type_id);

    //会员添加成功后，用数据库事务保证数据一致性，不错乱
    try {
        //创建一个事务管理器
        $manager = new Phalcon\Mvc\Model\Transaction\Manager();
        //获取一个新的事务
        $transaction = $manager->get();

        $member->setTransaction($transaction);
        if ($member->save($tree_info) === false) {
            $transaction->rollback("member_id = {$member_id} 的更新节点树信息失败");
            return queue_callback(false, "member_id = {$member_id} 的更新节点树信息失败");
        } else {
            //根据生成的新插入点的tree_id的奇偶性，就知道是插在了推荐人的左树还是右树
            $inviter = \Ypk\Models\Member::findFirst('member_id = ' . $inviter_id);
            if ($tree_info['member_tree_id'] % 2 == 0) {
                //左树
                //插入节点后更新推荐人的member_tree_left_invite_count字段，自加1;
                $member_tree_left_invite_count = $inviter->getMemberTreeLeftInviteCount() + 1;
                $inviter->setMemberTreeLeftInviteCount($member_tree_left_invite_count);

                $inviter->setTransaction($transaction);
                if ($inviter->save() === false) {
                    $transaction->rollback("在更新 member_id = {$member_id} 的节点树信息时更新邀请人 member_id = {$inviter->getMemberId()} 的member_tree_left_invite_count字段自加1时失败");
                    return queue_callback(false, "在更新 member_id = {$member_id} 的节点树信息时更新邀请人 member_id = {$inviter->getMemberId()} 的member_tree_left_invite_count字段自加1时失败");
                }
            } else {
                //右树
                //插入节点后更新推荐人的member_tree_right_invite_count字段，自加1;
                $member_tree_right_invite_count = $inviter->getMemberTreeRightInviteCount() + 1;
                $inviter->setMemberTreeRightInviteCount($member_tree_right_invite_count);

                $inviter->setTransaction($transaction);
                if ($inviter->save() === false) {
                    $transaction->rollback("在更新 member_id = {$member_id} 的节点树信息时更新邀请人 member_id = {$inviter->getMemberId()} 的member_tree_right_invite_count字段自加1时失败");
                    return queue_callback(false, "在更新 member_id = {$member_id} 的节点树信息时更新邀请人 member_id = {$inviter->getMemberId()} 的member_tree_right_invite_count字段自加1时失败");
                }
            }

            if ($member_type_id != 1) {
                //如果注册的是医护人员
                if ($inviter->getMemberTypeId() == 1) {
                    //如果推荐人是客户，把推荐人改成平台
                    $inviter = \Ypk\Models\Member::findFirst('member_id = ' . pow(2, 0));
                }
                //根据生成的新插入点的tree_id的奇偶性，就知道是插在了推荐人的左树还是右树
                if ($tree_info['store_tree_id'] % 2 == 0) {
                    //左树
                    //插入节点后更新推荐人的store_tree_left_invite_count字段，自加1;
                    $store_tree_left_invite_count = $inviter->getStoreTreeLeftInviteCount() + 1;
                    $inviter->setStoreTreeLeftInviteCount($store_tree_left_invite_count);

                    $inviter->setTransaction($transaction);
                    if ($inviter->save() === false) {
                        $transaction->rollback("在更新 member_id = {$member_id} 的节点树信息时更新邀请人 member_id = {$inviter->getMemberId()} 的store_tree_left_invite_count字段自加1时失败");
                        return queue_callback(false, "在更新 member_id = {$member_id} 的节点树信息时更新邀请人 member_id = {$inviter->getMemberId()} 的store_tree_left_invite_count字段自加1时失败");
                    }

                } else {
                    //右树
                    //插入节点后更新推荐人的store_tree_right_invite_count字段，自加1;
                    $store_tree_right_invite_count = $inviter->getStoreTreeRightInviteCount() + 1;
                    $inviter->setStoreTreeRightInviteCount($store_tree_right_invite_count);

                    $inviter->setTransaction($transaction);
                    if ($inviter->save() === false) {
                        $transaction->rollback("在更新 member_id = {$member_id} 的节点树信息时更新邀请人 member_id = {$inviter->getMemberId()} 的store_tree_right_invite_count字段自加1时失败");
                        return queue_callback(false, "在更新 member_id = {$member_id} 的节点树信息时更新邀请人 member_id = {$inviter->getMemberId()} 的store_tree_right_invite_count字段自加1时失败");
                    }
                }
            }
        }

        $transaction->commit();
        return queue_callback(true);

    } catch (Phalcon\Mvc\Model\Transaction\Failed $e) {
        return queue_callback(false, "member_id = {$member_id} 的更新节点树信息失败");
    }
}

/**
 * hpf
 *
 * 得到一个数组中key值在数组$keys中的数组
 *
 * @param array $whole_array
 * @param array $keys
 * @param string $field
 * @return array
 */
function get_Array_in_keys($whole_array, $keys, $field = 'member_tree_id')
{
    if (empty($whole_array) || empty($keys)) {
        return array();
    }
    $res_array = array_reduce($whole_array, function ($return_arr, $item) use ($keys, $field) {
        if (in_array($item[$field], $keys)) {
            $return_arr[$item[$field]] = $item;
        }
        return $return_arr;
    });

    return empty($res_array) ? array() : $res_array;
}

/**
 * hpf
 *
 * 得到一个二维数组中某个字段的和
 *
 * @param array $array
 * @param string $column
 * @return number
 */
function get_array_column_sum($array, $column)
{
    if (empty($array) || empty($column)) {
        return 0;
    }
    return array_sum(array_map(function ($val) use ($column) {
        return $val[$column];
    }, $array));
}

/**
 * hpf
 *
 * 得到一个二维数组中某字段的最大值
 *
 * @param array $array
 * @param string $column
 * @return int|mixed
 */
function get_array_column_max_value($array, $column)
{
    if (empty($array) || empty($column)) {
        return 0;
    }

    $res_array = array_column($array, $column);
    return max($res_array);
}

/**
 * hpf
 *
 * 检测最大碰撞次数
 *
 * @param int $a 可用积分较大的一边含有多少个3000
 * @param int $b 可用积分较小的一边含有多少个3000
 * @return int
 */
function get_max_collision_times($a, $b)
{
    $b_temp = $b + 1;
    while (true) {
        $b_temp--;
        if ($b_temp <= 0) {
            //不能碰撞，退出
            break;
        }
        //后台管理设置时collision_big_ratio必须比collision_small_ratio大，千万别弄反
        if ($a / $b_temp >= getConfig('collision_big_ratio') / getConfig('collision_small_ratio')) {
            //可以碰撞$b_temp次
            break;
        }
    }

    return $b_temp <= 0 ? 0 : $b_temp;
}

/**
 * hpf
 *
 * 每个月月底评定一次客户树所有会员的等级
 *
 * 警告：定时必须是下一个月的第一天的00:01:00
 * 此函数必须是每一月的第一天进行调用，统计的是上一个月的月等级
 *
 * @return array
 */
function update_member_month_level()
{
    //积分碰撞基数 3000
    $points_base_number = getConfig('points_base_number');

    //等级区分比率
    $member_month_level_rate = getConfig('member_month_level_rate');
    if (empty($member_month_level_rate)) {
        return queue_callback(true);
    }

    $max_tree_row = \Ypk\Models\Member::maximum(array('column' => 'member_tree_row'));
    if ($max_tree_row == 0) {
        return queue_callback(true);
    }
    $whole_tree_ids[] = 1;
    $whole_tree_child_ids = get_whole_tree_child_ids($whole_tree_ids[0], $max_tree_row);
    if (count($whole_tree_child_ids) > 0) {
        $whole_tree_ids = array_merge($whole_tree_ids, $whole_tree_child_ids);
    }

    //上月一号的00:00:00
    $prev_month_start_time = get_prev_month_first_time();
    //上月最后一天的23:59:59
    $prev_month_end_time = get_prev_month_last_time();

    //查出客户树所有会员在当前月的积分碰撞记录
    $points_collision_logs = \Ypk\Models\MemberPointsCollisionLog::find(array('member_tree_id IN (' . implode(',', $whole_tree_ids) . ') AND add_time BETWEEN ' . $prev_month_start_time . ' AND ' . $prev_month_end_time, 'columns' => 'member_id,member_tree_id,SUM(member_self_used_points) as self_used_points,SUM(member_left_used_points) as left_used_points,SUM(member_right_used_points) as right_used_points', 'group' => 'member_tree_id'));
    if (count($points_collision_logs) <= 0) {
        return queue_callback(true);
    }
    $points_collision_logs = $points_collision_logs->toArray();
    $member_month_levels = array_map(function ($points_collision_log) use ($points_base_number, $member_month_level_rate) {
        $self_used_points = $points_collision_log['self_used_points'];
        $left_used_points = $points_collision_log['left_used_points'];
        $right_used_points = $points_collision_log['right_used_points'];
        if ($left_used_points < $points_base_number && $right_used_points < $points_base_number) {
            return array();
        }

        $max = 0;
        $min = 0;
        $tree_level = 0; //默认是一级

        if ($left_used_points >= $points_base_number && $right_used_points >= $points_base_number && $left_used_points >= $right_used_points) {
            //左边大
            $max = $left_used_points + $self_used_points;
            $min = $right_used_points;
        }

        if ($left_used_points >= $points_base_number && $right_used_points >= $points_base_number && $left_used_points < $right_used_points) {
            //右边大
            $max = $right_used_points + $self_used_points;
            $min = $left_used_points;
        }

        if ($left_used_points >= $points_base_number && $right_used_points < $points_base_number) {
            $max = $left_used_points;
            $min = $right_used_points + $self_used_points;
            if ($max < $min) {
                $temp = $min;
                $min = $max;
                $max = $temp;
            }
        }

        if ($left_used_points < $points_base_number && $right_used_points >= $points_base_number) {
            $max = $right_used_points;
            $min = $left_used_points + $self_used_points;
            if ($max < $min) {
                $temp = $min;
                $min = $max;
                $max = $temp;
            }
        }

        $a = floor($min / 3000);
        $b = floor($max / 3000);

        $level_index = 10;
        while (true) {
            $level_index--;
            if ($level_index === 0) {
                break;
            }
            if ($a >= $member_month_level_rate[$level_index][0] && $b >= $member_month_level_rate[$level_index][1]) {
                $tree_level = $level_index;
                break;
            }
        }

        if ($tree_level > 0) {
            return array($points_collision_log['member_tree_id'] => array('member_id' => $points_collision_log['member_id'], 'member_tree_id' => $points_collision_log['member_tree_id'], 'member_month_level' => $tree_level));
        } else {
            return array();
        }
    }, $points_collision_logs);

    //更新数据库对应节点本月的评定的级别
    foreach ($member_month_levels as $member_month_level) {
        if (empty($member_month_level)) {
            continue;
        }
        $member_month_level['month_tree_level_type'] = 0;
        $member_month_level['add_month'] = intval(date('m', strtotime('-1 month')));
        $member_month_level['add_jidu'] = get_curr_jidu($member_month_level['add_month']);
        $member_month_tree_level = new \Ypk\Models\MemberMonthTreeLevel();
        if ($member_month_tree_level->save($member_month_level) === false) {
            \Ypk\Log::record("member {$member_month_level['member_id']}添加{$member_month_level['add_jidu']}季度{$member_month_level['add_month']}月member_month_level为{$member_month_level['member_month_level']}时失败");
        }
    }

    if (is_curr_jidu_first_month()) {
        //如果当前时刻是本季度的第一个月，计算上一个季度的季度积分碰撞等级
        return update_member_tree_final_level();
    }

    return queue_callback(true);
}

/**
 * hpf
 *
 * 一个季度更新一次客户树中每个会员积分碰撞的终身等级
 * 此函数必须是每一季度的第一天进行调用，统计的是上一个季度的季度等级
 * 这个函数是被update_member_month_level()函数调用的内置函数，不需要单独做定时操作
 *
 * @return array
 */
function update_member_tree_final_level()
{
    if (!is_curr_jidu_first_month()) {
        return queue_callback(true);
    }

    //上一季度
    $prev_jidu = get_curr_jidu() - 1;

    $member_month_tree_levels = \Ypk\Models\MemberMonthTreeLevel::find('month_tree_level_type = 0 and add_jidu = ' . $prev_jidu);
    if (count($member_month_tree_levels) <= 0) {
        return queue_callback(true);
    }

    $member_month_tree_levels = $member_month_tree_levels->toArray();

    $member_month_levels = array();
    foreach ($member_month_tree_levels as $member_month_tree_level) {
        $member_month_levels[$member_month_tree_level['member_tree_id']][] = $member_month_tree_level['member_month_level'];
    }

    foreach ($member_month_levels as $member_tree_id => $member_month_level) {
        $jidu_level = 0;
        sort($member_month_level);
        if (count($member_month_level) == 3) {
            //在评定出的三个碰撞次数等级中，去掉一个最低数值和一个最高数值，剩下的数值作为本季度的荣誉等级
            $jidu_level = $member_month_level[1];
        } elseif (count($member_month_level) == 2) {
            //如果上季度有两个碰撞次数等级，去掉一个最低数值，最高的数值作为上季度的荣誉等级
            $jidu_level = $member_month_level[1];
        } elseif (count($member_month_level) == 1) {
            //如果上季度有一个碰撞次数等级，就把这个数值作为上季度的荣誉等级
            $jidu_level = $member_month_level[0];
        }

        if ($jidu_level !== 0) {
            $member = \Ypk\Models\Member::findFirst('member_tree_id = ' . $member_tree_id . ' and member_state = 1');
            if ($member !== false && $member->getMemberTreeFinalLevel() < $jidu_level) {
                if ($member->save(array('member_tree_final_level' => $jidu_level)) == false) {
                    \Ypk\Log::record("member {$member->getMemberId()}更新{$prev_jidu}季度的member_tree_final_level为{$jidu_level}时失败");
                }
            }
        }
    }

    return queue_callback(true);
}

/**
 * hpf
 *
 * 每个月月底评定一次医务人员树所有人员的等级
 *
 * 警告：定时必须是下一个月的第一天的00:01:00
 * 此函数必须是每一月的第一天进行调用，统计的是上一个月的月等级
 *
 * @return array
 */
function update_store_month_level()
{
    //积分碰撞基数 3000
    $points_base_number = getConfig('points_base_number');

    //等级区分比率
    $member_month_level_rate = getConfig('member_month_level_rate');
    if (empty($member_month_level_rate)) {
        return queue_callback(true);
    }

    $max_tree_row = \Ypk\Models\Member::maximum(array('column' => 'store_tree_row'));
    if ($max_tree_row == 0) {
        return queue_callback(true);
    }
    $whole_tree_ids[] = 1;
    $whole_tree_child_ids = get_whole_tree_child_ids($whole_tree_ids[0], $max_tree_row);
    if (count($whole_tree_child_ids) > 0) {
        $whole_tree_ids = array_merge($whole_tree_ids, $whole_tree_child_ids);
    }

    //上月一号的00:00:00
    $prev_month_start_time = get_prev_month_first_time();
    //上月最后一天的23:59:59
    $prev_month_end_time = get_prev_month_last_time();

    //查出医护人员树所有会员在当前月的积分碰撞记录
    $points_collision_logs = \Ypk\Models\MemberPointsCollisionLog::find(array('store_tree_id IN (' . implode(',', $whole_tree_ids) . ') AND add_time BETWEEN ' . $prev_month_start_time . ' AND ' . $prev_month_end_time, 'columns' => 'member_id,store_tree_id,SUM(store_self_used_points) as self_used_points,SUM(store_left_used_points) as left_used_points,SUM(store_right_used_points) as right_used_points', 'group' => 'store_tree_id'));
    if (count($points_collision_logs) <= 0) {
        return queue_callback(true);
    }
    $points_collision_logs = $points_collision_logs->toArray();
    $store_month_levels = array_map(function ($points_collision_log) use ($points_base_number, $member_month_level_rate) {
        $self_used_points = $points_collision_log['self_used_points'];
        $left_used_points = $points_collision_log['left_used_points'];
        $right_used_points = $points_collision_log['right_used_points'];
        if ($left_used_points < $points_base_number && $right_used_points < $points_base_number) {
            return array();
        }

        $max = 0;
        $min = 0;
        $tree_level = 0; //默认是一级

        if ($left_used_points >= $points_base_number && $right_used_points >= $points_base_number && $left_used_points >= $right_used_points) {
            //左边大
            $max = $left_used_points + $self_used_points;
            $min = $right_used_points;
        }

        if ($left_used_points >= $points_base_number && $right_used_points >= $points_base_number && $left_used_points < $right_used_points) {
            //右边大
            $max = $right_used_points + $self_used_points;
            $min = $left_used_points;
        }

        if ($left_used_points >= $points_base_number && $right_used_points < $points_base_number) {
            $max = $left_used_points;
            $min = $right_used_points + $self_used_points;
            if ($max < $min) {
                $temp = $min;
                $min = $max;
                $max = $temp;
            }
        }

        if ($left_used_points < $points_base_number && $right_used_points >= $points_base_number) {
            $max = $right_used_points;
            $min = $left_used_points + $self_used_points;
            if ($max < $min) {
                $temp = $min;
                $min = $max;
                $max = $temp;
            }
        }

        $a = floor($min / 3000);
        $b = floor($max / 3000);

        $level_index = 10;
        while (true) {
            $level_index--;
            if ($level_index === 0) {
                break;
            }
            if ($a >= $member_month_level_rate[$level_index][0] && $b >= $member_month_level_rate[$level_index][1]) {
                $tree_level = $level_index;
                break;
            }
        }

        if ($tree_level > 0) {
            return array($points_collision_log['store_tree_id'] => array('member_id' => $points_collision_log['member_id'], 'store_tree_id' => $points_collision_log['store_tree_id'], 'store_month_level' => $tree_level));
        } else {
            return array();
        }
    }, $points_collision_logs);

    //更新数据库对应节点本月的评定的级别
    foreach ($store_month_levels as $store_month_level) {
        if (empty($store_month_level)) {
            continue;
        }
        $store_month_level['month_tree_level_type'] = 1;
        $store_month_level['add_month'] = intval(date('m', strtotime('-1 month')));
        $store_month_level['add_jidu'] = get_curr_jidu($store_month_level['add_month']);
        $member_month_tree_level = new \Ypk\Models\MemberMonthTreeLevel();
        if ($member_month_tree_level->save($store_month_level) === false) {
            \Ypk\Log::record("member {$store_month_level['member_id']}添加{$store_month_level['add_jidu']}季度{$store_month_level['add_month']}月store_month_level为{$store_month_level['store_month_level']}时失败");
        }
    }

    if (is_curr_jidu_first_month()) {
        //如果当前时刻是本季度的第一个月，计算上一个季度的季度积分碰撞等级
        return update_store_tree_final_level();
    }

    return queue_callback(true);
}

/**
 * hpf
 *
 * 一个季度更新一次医务人员树中每个会员积分碰撞的终身等级
 *
 * 此函数必须是每一季度的第一天进行调用，统计的是上一个季度的季度等级
 * 这个函数是被update_store_month_level()函数调用的内置函数，不需要单独做定时操作
 *
 * @return array
 */
function update_store_tree_final_level()
{
    if (!is_curr_jidu_first_month()) {
        return queue_callback(true);
    }

    //上一季度
    $prev_jidu = get_curr_jidu() - 1;

    $member_month_tree_levels = \Ypk\Models\MemberMonthTreeLevel::find('month_tree_level_type = 1 and add_jidu = ' . $prev_jidu);
    if (count($member_month_tree_levels) <= 0) {
        return queue_callback(true);
    }

    $member_month_tree_levels = $member_month_tree_levels->toArray();

    $store_month_levels = array();
    foreach ($member_month_tree_levels as $member_month_tree_level) {
        $store_month_levels[$member_month_tree_level['store_tree_id']][] = $member_month_tree_level['store_month_level'];
    }

    foreach ($store_month_levels as $store_tree_id => $store_month_level) {
        $jidu_level = 0;
        sort($store_month_level);
        if (count($store_month_level) == 3) {
            //在评定出的三个碰撞次数等级中，去掉一个最低数值和一个最高数值，剩下的数值作为本季度的荣誉等级
            $jidu_level = $store_month_level[1];
        } elseif (count($store_month_level) == 2) {
            //如果上季度有两个碰撞次数等级，去掉一个最低数值，最高的数值作为上季度的荣誉等级
            $jidu_level = $store_month_level[1];
        } elseif (count($store_month_level) == 1) {
            //如果上季度有一个碰撞次数等级，就把这个数值作为上季度的荣誉等级
            $jidu_level = $store_month_level[0];
        }

        if ($jidu_level !== 0) {
            $member = \Ypk\Models\Member::findFirst('store_tree_id = ' . $store_tree_id . ' and member_state = 1');
            if ($member !== false && $member->getStoreTreeFinalLevel() < $jidu_level) {
                if ($member->save(array('store_tree_final_level' => $jidu_level)) == false) {
                    \Ypk\Log::record("member {$member->getMemberId()}更新{$prev_jidu}季度的store_tree_final_level为{$jidu_level}时失败");
                }
            }
        }
    }

    return queue_callback(true);
}

/**
 * hpf
 *
 * 检查会员金，银，铜等级的升级
 *
 * 加入单独的队列执行，如果一个推荐人的多个子级同时发生级别改变，每个子级别在自己的级别修改后去查询父级的级别时都会少查一个子会员的铜银，所以用队列一个一个执行
 *
 * @param array $array
 * @return array
 */
function update_member_tree_level($array)
{
    $member_id = $array['member_id']; //购买者或者充值者member_id
    if (empty($member_id) || $member_id <= 0) {
        return queue_callback(true);
    }
    $member_name = isset($array['member_name']) ? $array['member_name'] : ''; //一次性消费金额或者一次性充值金额
    $money = isset($array['money']) ? $array['money'] : 0; //一次性消费金额或者一次性充值金额
    $update_type = isset($array['update_type']) ? $array['update_type'] : 0;//升级类型 0是一次性消费升级 1是一次性充值升级 2推荐够十个相应级别的会员升级

    //查出购买者或者充值者
    $members = \Ypk\Models\Member::findFirst('member_id = ' . $member_id);
    if ($members === false) {
        //会员不存在
        return queue_callback(true);
    }

    if ($members->getMemberState() === 0) {
        //会员被关闭
        return queue_callback(true);
    }

    $member_tree_level_config = getConfig('member_tree_level');

    $member_tree_level = 1; //默认铜卡
    if ($money >= $member_tree_level_config[3]['pay_money']) {
        //判断当前会员充值或者消费够不够大于等于3000
        $member_tree_level = 3; //金卡
    } elseif ($money >= $member_tree_level_config[2]['pay_money']) {
        //判断当前会员充值或者消费够不够大于等于1500
        $member_tree_level = 2; //银卡
    }

    $buy_type_name = '一次性消费';
    if ($update_type == 1) {
        $buy_type_name = '一次性充值';
    }

    if ($member_tree_level > $members->getMemberTreeLevel()) {
        //如果本次计算出的级别比他原有的高
        if ($members->save(array('member_tree_level' => $member_tree_level, 'upgrade_time' => time())) === false) {
            \Ypk\Log::record("会员member_id={$member_id}因{$buy_type_name}{$money}元升级为{$member_tree_level}卡时更新数据失败，时间" . time());
        }
        //添加会员升级日志
        $update_tree_level_log_data['member_id'] = $member_id;
        $update_tree_level_log_data['member_name'] = $member_name;
        $update_tree_level_log_data['member_tree_level'] = $member_tree_level;
        $update_tree_level_log_data['update_type'] = $update_type;
        $update_tree_level_log_data['by_count'] = $money;
        $update_tree_level_log_data['add_time'] = time();
        $update_tree_level_log = new \Ypk\Models\MemberUpdateTreeLevelLog();
        if ($update_tree_level_log->save($update_tree_level_log_data) === false) {
            \Ypk\Log::record("添加会员member_id={$member_id}升级为{$member_tree_level}卡日志时日志数据添加失败，数据" . json_encode($update_tree_level_log_data));
        }

        //本人的金银铜级别变了，要检查他的推荐人会不会因为推荐他而升级
        //有没有推荐10个金卡
        $inviter = \Ypk\Models\Member::findFirst('inviter_id = ' . $members->getInviterId());
        if ($inviter === false) {
            //会员不存在
            return queue_callback(true);
        }

        if ($inviter->getMemberState() === 0) {
            //会员被关闭
            return queue_callback(true);
        }

        if ($inviter->getMemberTreeLevel() == 3) {
            //推荐人已经是金卡
            return queue_callback(true);
        }

        //推荐人已经推荐的金卡会员的数量
        $invite_tree_level = 1;
        $invite_tree_level_name = '铜卡';
        $invite_yin_member_count = \Ypk\Models\Member::count("member_state = 1 and inviter_id = {$members->getInviterId()} and member_tree_level >= 2");
        if ($invite_yin_member_count > 10) {
            $invite_tree_level = 2;
            $invite_tree_level_name = '银卡';
        }

        $invite_jin_member_count = \Ypk\Models\Member::count("member_state = 1 and inviter_id = {$members->getInviterId()} and member_tree_level = 3");
        if ($invite_jin_member_count > 10) {
            $invite_tree_level = 3;
            $invite_tree_level_name = '金卡';
        }

        if ($invite_tree_level > $inviter->getMemberTreeLevel()) {
            //如果本次计算出的级别比他原有的高
            if ($inviter->save(array('member_tree_level' => $invite_tree_level, 'upgrade_time' => time())) === false) {
                \Ypk\Log::record("会员member_id={$inviter->getMemberId()}因推荐了10个{$invite_tree_level_name}会员升级为{$invite_tree_level}卡时更新数据失败，时间" . time());
            }
            //添加会员升级日志
            $update_invite_tree_level_log_data['member_id'] = $inviter->getMemberId();
            $update_invite_tree_level_log_data['member_name'] = $inviter->getMemberName();
            $update_invite_tree_level_log_data['member_tree_level'] = $invite_tree_level;
            $update_invite_tree_level_log_data['update_type'] = 2;
            $update_invite_tree_level_log_data['by_count'] = 10; //推荐了10个人
            $update_invite_tree_level_log_data['add_time'] = time();
            $update_invite_tree_level_log = new \Ypk\Models\MemberUpdateTreeLevelLog();
            if ($update_invite_tree_level_log->save($update_invite_tree_level_log_data) === false) {
                \Ypk\Log::record("添加会员member_id={$inviter->getMemberId()}升级为{$invite_tree_level}卡日志时日志数据添加失败，数据" . json_encode($update_invite_tree_level_log_data));
            }
        }
    }

    return queue_callback(true);
}

/**
 * hpf
 *
 * 得到当前季度或者指定月份所在的季度
 *
 * @param int $month
 * @return int
 */
function get_curr_jidu($month = null)
{
    if (empty($month)) {
        //当前季度从几月份开始
        return ceil(date('m') / 3);
    } else {
        return ceil($month / 3);
    }
}

/**
 * hpf
 *
 * 得到当前季度的第一天第一秒的时间
 *
 * @return int
 */
function get_curr_jidu_first_time()
{
    $jidu = get_curr_jidu();
    $first_month = ($jidu - 1) * 3 + 1;
    return strtotime(date("Y -{$first_month}-01 00:00:00"));
}

/**
 * hpf
 *
 * 得到当前季度最后一天最后一秒的时间
 *
 * @return int
 */
function get_curr_jidu_last_time()
{
    $curr_jidu_first_day = date('Y-m-d H:i:s', get_curr_jidu_first_time());
    return strtotime(date('Y-m-d 23:59:59', strtotime("{$curr_jidu_first_day} +3 month - 1 day")));
}

/**
 * hpf
 *
 * 得到当前季度第一天的日期
 *
 * @return false|int
 */
function get_curr_jidu_first_day()
{
    return strtotime(date('Y-m-d', get_curr_jidu_first_time()));
}

/**
 * hpf
 *
 * 得到当前季度最后一天的日期
 *
 * @return false|int
 */
function get_curr_jidu_last_day()
{
    return strtotime(date('Y-m-d', get_curr_jidu_last_time()));
}

/**
 * hpf
 *
 * 得到当前日期
 *
 * @return false|int
 */
function get_curr_day()
{
    return strtotime(date('Y-m-d'));
}

/**
 * hpf
 *
 * 获取上一个月的第一秒时间
 *
 * @return false|int
 */
function get_prev_month_first_time()
{
    $curr_month_first_time = strtotime(date('Y-m-01 00:00:00'));
    //上月一号的00:00:00
    return strtotime(date('Y-m-01 00:00:00', strtotime('-1 month', $curr_month_first_time)));
}

/**
 * hpf
 *
 * 获取上一个月的最后一秒的时间
 *
 * @return false|int
 */
function get_prev_month_last_time()
{
    $curr_month_first_time = strtotime(date('Y-m-01 00:00:00'));
    //上月最后一天的23:59:59
    return strtotime(date('Y-m-d 23:59:59', strtotime('-1 day', $curr_month_first_time)));
}

/**
 * hpf
 *
 * 检测当前时刻是否是本季度第一个月
 *
 * @return bool
 */
function is_curr_jidu_first_month()
{
    $curr_jidu = get_curr_jidu();
    $curr_jidu_first_month = ($curr_jidu - 1) * 3 + 1;
    $curr_month = intval(date('m'));

    if ($curr_jidu_first_month == $curr_month) {
        return true;
    } else {
        return false;
    }
}

//--------------------------------------------------------------四大计算------------------------------------------------

/**
 * 为医务人员添加分利和直荐奖
 * ycg
 *
 * @param array $order_info
 * @return array
 */
function add_doctor_share_benefits($order_info)
{
    if (!empty($order_info['order_type']) && $order_info['order_type'] == 'real_order') { //表示是实物订单
        //找到本订单中所有商品（或服务）的id集合
        $order_goods_list = \Ypk\Models\OrderGoods::find(array("conditions" => "order_id = " . $order_info['order_id']));
        $order_goods_list = $order_goods_list->toArray();
        if (count($order_goods_list) <= 0) {
            return queue_callback(true);
        }
        $goods_ids_array = array();
        $goods_num_array = array();
        foreach ($order_goods_list as $order_goods) {
            $goods_ids_array[] = $order_goods['goods_id'];
            $goods_num_array[$order_goods['goods_id']] = $order_goods['goods_num'];
        }
        $goods_list = \Ypk\Models\Goods::find(array("conditions" => "goods_id in (" . implode($goods_ids_array) . ")"));
        $goods_list = $goods_list->toArray();
        if (count($goods_list) <= 0) {
            return queue_callback(true);
        }
        foreach ($goods_list as $goods) {
            if ($goods['gc_id_1'] != 1073 && $goods['gc_id_1'] != 1076) {
                //如果该商品不是服务类型
                continue;
            }
            $doctor_share_benefit_sum = floatval($goods['doctor_private_price']) * getConfig('doctor_share_benefits_rate') * $goods_num_array[$goods['goods_id']]; //医务人员分利奖金金额
            //更新医生分利
            $store_info = \Ypk\Models\Store::findFirst('store_id = ' . $goods['store_id']);
            if ($store_info === false) {
                continue;
            }
            $doctor_info = \Ypk\Models\Member::findFirst('member_id = ' . $store_info->getMemberId());
            if ($doctor_info === false || $doctor_info->getMemberState() == 0) {
                continue;
            }
            if ($doctor_info->save(array('store_share_benefits_money_sum' => $doctor_info->getStoreShareBenefitsMoneySum() + $doctor_share_benefit_sum)) === false) {
                \Ypk\Log::record("实物订单，更新医护人员member_id={$doctor_info->getMemberId()}的分利{$doctor_share_benefit_sum}元时失败，时间：" . time());
            }
            $share_benefits_log_data = array(
                "member_id" => $doctor_info->getMemberId(),
                "share_benefits_money" => $doctor_share_benefit_sum,
                "goods_id" => $goods['goods_id'],
                "goods_name" => $goods['goods_name'],
                "buyer_id" => $order_info['buyer_id'],
                "buyer_name" => $order_info['buyer_name'],
                "doctor_private_price" => $goods['doctor_private_price'],
                "buy_num" => $goods_num_array[$goods['goods_id']],
                "add_time" => time(),
                "order_id" => $order_info['order_id']
            );
            $member_share_benefits_log = new \Ypk\Models\MemberShareBenefitsLog();
            if ($member_share_benefits_log->save($share_benefits_log_data) === false) {
                \Ypk\Log::record("实物订单，添加医护人员member_id={$doctor_info->getMemberId()}分利日志时失败，数据是：" . json_encode($share_benefits_log_data));
            }

            //计算医护人员直荐奖
            if (is_null($doctor_info->getInviterId())) {
                continue;
            }
            $inviter_info = \Ypk\Models\Member::findFirst("member_id=" . $doctor_info->getInviterId()); //获取直接推荐人
            if ($inviter_info === false || $inviter_info->getMemberState() == 0) {
                continue;
            }

            //判断是否有直荐奖获取权限
            if (empty($inviter_info->getMemberTreeLevel())) {
                continue;
            }
            if (!in_array('straight', getConfig('member_tree_level')[$inviter_info->getMemberTreeLevel()]['has_permission'])) {
                continue;
            }
            $invite_straight_money = $doctor_share_benefit_sum * getConfig('member_tree_level')[$inviter_info->getMemberTreeLevel()]['straight_money_base_rate']; //计算出父推荐人应获取的直荐奖奖金
            if ($inviter_info->save(array("store_straight_money_sum" => $inviter_info->getStoreStraightMoneySum() + $invite_straight_money)) === false) {
                \Ypk\Log::record("实物订单，因医护人员member_id={$doctor_info->getMemberId()}获取分利{$doctor_share_benefit_sum}元而更新member_id={$inviter_info->getMemberId()}的{$invite_straight_money}元直荐奖时失败!");
            }

            //写入直荐日志表
            $inviter_straight_log = new \Ypk\Models\MemberStraightLog();
            $straight_log_data = array(
                "member_id" => $inviter_info->getMemberId(),
                "buyer_id" => $order_info['buyer_id'],
                "buyer_name" => $order_info['buyer_name'],
                "seller_id" => $doctor_info->getMemberId(),
                "seller_name" => $doctor_info->getMemberName(),
                "sale_money" => $doctor_share_benefit_sum,
                "store_straight_money" => $invite_straight_money,
                "member_tree_type" => 1,
                "add_time" => time(),
                "order_id" => $order_info['order_id']
            );
            if ($inviter_straight_log->save($straight_log_data) === false) {
                \Ypk\Log::record("因医护人员member_id={$doctor_info->getMemberId()}获取分利{$doctor_share_benefit_sum}元而添加member_id={$inviter_info->getMemberId()}的{$invite_straight_money}元直荐奖日志时失败!数据为：" . json_encode($straight_log_data));
            }
        } //for循环结束
    }
    elseif (!empty($order_info['order_type']) && $order_info['order_type'] == 'vr_order') { //表示是虚拟订单
        $goods_id = $order_info['goods_id'];
        if (empty($goods_id)) {
            return queue_callback(true);
        }
        $goods_info = \Ypk\Models\Goods::findFirst("goods_id=" . $goods_id);
        if ($goods_info === false) {
            return queue_callback(true);
        }
        $doctor_share_benefit = $goods_info->getDoctorPrivatePrice() * getConfig('doctor_share_benefits_rate'); //获取分利奖
        //更新医生分利
        $store_info = \Ypk\Models\Store::findFirst('store_id = ' . $goods_info->getStoreId());
        if ($store_info === false) {
            return queue_callback(true);
        }
        $doctor_info = \Ypk\Models\Member::findFirst('member_id = ' . $store_info->getMemberId());
        if ($doctor_info === false || $doctor_info->getMemberState() == 0) {
            return queue_callback(true);
        }
        if ($doctor_info->save(array('store_share_benefits_money_sum' => $doctor_info->getStoreShareBenefitsMoneySum() + $doctor_share_benefit)) === false) {
            \Ypk\Log::record("虚拟订单，更新医护人员member_id={$doctor_info->getMemberId()}的分利{$doctor_share_benefit}元时失败，时间：" . time());
        }
        $share_benefits_log_data = array(
            "member_id" => $doctor_info->getMemberId(),
            "share_benefits_money" => $doctor_share_benefit,
            "goods_id" => $goods_info->getGoodsId(),
            "goods_name" => $goods_info->getGoodsName(),
            "buyer_id" => $order_info['buyer_id'],
            "buyer_name" => $order_info['buyer_name'],
            "doctor_private_price" => $goods_info->getDoctorPrivatePrice(),
            "buy_num" => 1,
            "add_time" => time(),
            "order_id" => $order_info['order_id']
        );
        $member_share_benefits_log = new \Ypk\Models\MemberShareBenefitsLog();
        if ($member_share_benefits_log->save($share_benefits_log_data) === false) {
            \Ypk\Log::record("虚拟订单，添加医护人员member_id={$doctor_info->getMemberId()}分利日志时失败，数据是：" . json_encode($share_benefits_log_data));
        }
        //计算医护人员直荐奖
        if (is_null($doctor_info->getInviterId())) {
            return queue_callback(true);
        }
        $inviter_info = \Ypk\Models\Member::findFirst("member_id=" . $doctor_info->getInviterId()); //获取直接推荐人
        if ($inviter_info === false || $inviter_info->getMemberState() == 0) {
            return queue_callback(true);
        }

        //判断直荐人的身份类型，如果直荐人是普通客户，则需要把直荐奖给平台
        if (intval($inviter_info->getMemberTypeId()) === 1) {
            $inviter_info = \Ypk\Models\Member::findFirst("member_id=1"); //把直荐奖给平台
        }

        //判断是否有直荐奖获取权限
        if (empty($inviter_info->getMemberTreeLevel())) {
            return queue_callback(true);
        }
        if (!in_array('straight', getConfig('member_tree_level')[$inviter_info->getMemberTreeLevel()]['has_permission'])) {
            return queue_callback(true);
        }
        $invite_straight_money = $doctor_share_benefit * getConfig('member_tree_level')[$inviter_info->getMemberTreeLevel()]['straight_money_base_rate']; //计算出父推荐人应获取的直荐奖奖金
        if ($inviter_info->save(array("store_straight_money_sum" => $inviter_info->getStoreStraightMoneySum() + $invite_straight_money)) === false) {
            \Ypk\Log::record("虚拟订单，因医护人员member_id={$doctor_info->getMemberId()}获取分利{$doctor_share_benefit}元而更新member_id={$inviter_info->getMemberId()}的{$invite_straight_money}元直荐奖时失败!");
        }
        //写入直荐日志表
        $inviter_straight_log = new \Ypk\Models\MemberStraightLog();
        $straight_log_data = array(
            "member_id" => $inviter_info->getMemberId(),
            "buyer_id" => $order_info['buyer_id'],
            "buyer_name" => $order_info['buyer_name'],
            "seller_id" => $doctor_info->getMemberId(),
            "seller_name" => $doctor_info->getMemberName(),
            "sale_money" => $doctor_share_benefit, //分利奖
            "store_straight_money" => $invite_straight_money, //直荐奖
            "member_tree_type" => 1,
            "add_time" => time(),
            "order_id" => $order_info['order_id']
        );
        if ($inviter_straight_log->save($straight_log_data) === false) {
            \Ypk\Log::record("因医护人员member_id={$doctor_info->getMemberId()}获取分利{$doctor_share_benefit}元而添加member_id={$inviter_info->getMemberId()}的{$invite_straight_money}元直荐奖日志时失败!数据为：" . json_encode($straight_log_data));
        }
    }
    else {
        return queue_callback(true);
    }
    return queue_callback(true);
}

/**
 * 为医务人员添加积分
 * ycg
 *
 * @param array $order_info
 * @return array
 */
function add_doctor_points($order_info)
{
    if (!empty($order_info['order_type']) && $order_info['order_type'] == 'real_order') {  //表示实物订单
        //找到本订单中所有商品（或服务）的id集合
        $order_goods_list = \Ypk\Models\OrderGoods::find(array("conditions" => "order_id = " . $order_info['order_id']));
        $order_goods_list = $order_goods_list->toArray();
        if (count($order_goods_list) <= 0) {
            return queue_callback(true);
        }
        $goods_ids_array = array();
        $goods_num_array = array();
        foreach ($order_goods_list as $order_goods) {
            $goods_ids_array[] = $order_goods['goods_id'];
            $goods_num_array[$order_goods['goods_id']] = $order_goods['goods_num'];
        }
        $goods_list = \Ypk\Models\Goods::find(array("conditions" => "goods_id in (" . implode($goods_ids_array) . ")"));
        $goods_list = $goods_list->toArray();
        if (count($goods_list) <= 0) {
            return queue_callback(true);
        }
        foreach ($goods_list as $goods) {
            if ($goods['gc_id_1'] != 1073 && $goods['gc_id_1'] != 1076) {
                //如果该商品不是服务类型
                continue;
            }
            $doctor_points_sum = floatval($goods['doctor_private_price']) * getConfig('doctor_get_points_rate') * $goods_num_array[$goods['goods_id']]; //医务人员积分
            $doctor_points_sum = intval($doctor_points_sum);
            //更新医生积分
            $store_info = \Ypk\Models\Store::findFirst('store_id = ' . $goods['store_id']);
            if ($store_info === false) {
                continue;
            }
            $doctor_info = \Ypk\Models\Member::findFirst('member_id = ' . $store_info->getMemberId());
            if ($doctor_info === false || $doctor_info->getMemberState() == 0) {
                continue;
            }
            if ($doctor_info->save(array('store_points' => $doctor_info->getStorePoints() + $doctor_points_sum)) === false) {
                \Ypk\Log::record("实物订单完成时，更新医护人员member_id={$doctor_info->getMemberId()}的积分{$doctor_points_sum}分时失败，时间：" . time());
            }
            //写入积分日志
            $points_log_data = array(
                "pl_memberid" => $doctor_info->getMemberId(),
                "pl_membername" => $doctor_info->getMemberName(),
                "pl_adminid" => $doctor_info->getMemberId(),
                "pl_adminname" => $doctor_info->getMemberName(),
                "pl_points" => $doctor_points_sum,
                "tree_type" => 1,
                "pl_addtime" => time(),
                "pl_desc" => "实物订单完成时赠送给卖家的积分",
                "pl_stage" => "实物订单完成时赠送卖家的积分",
                "order_id" => $order_info['order_id']
            );
            $points_log = new \Ypk\Models\PointsLog();
            if ($points_log->save($points_log_data) === false) {
                \Ypk\Log::record("卖出实物产品，添加医护人员member_id={$doctor_info->getMemberId()}的积分日志时失败，数据为：" . json_encode($points_log_data));
            }
        }
    } elseif (!empty($order_info['order_type']) && $order_info['order_type'] == 'vr_order') { //表示是虚拟订单
        $goods_id = $order_info['goods_id'];
        if (!empty($goods_id)) {
            $goods_info = \Ypk\Models\Goods::findFirst("goods_id=" . $goods_id);
            if ($goods_info !== false) {
                $goods_points = $goods_info->getDoctorPrivatePrice() * getConfig('doctor_get_points_rate'); //医生发布的商品的私有价格乘以对应的比例，就是医生应该得到的积分
                //更新医生积分
                $store_info = \Ypk\Models\Store::findFirst('store_id = ' . $goods_info->getStoreId());
                if ($store_info === false) {
                    return queue_callback(true);
                }
                $doctor_info = \Ypk\Models\Member::findFirst('member_id = ' . $store_info->getMemberId());
                if ($doctor_info === false || $doctor_info->getMemberState() == 0) { //判断医生是否存在并且状态是否正常
                    return queue_callback(true);
                }
                if ($doctor_info->save(array('store_points' => $doctor_info->getStorePoints() + $goods_points)) === false) {
                    \Ypk\Log::record("虚拟订单完成时，更新医护人员member_id={$doctor_info->getMemberId()}的积分{$goods_points}分时失败，时间：" . time());
                }
                //写入积分日志
                $points_log_data = array(
                    "pl_memberid" => $doctor_info->getMemberId(),
                    "pl_membername" => $doctor_info->getMemberName(),
                    "pl_adminid" => $doctor_info->getMemberId(),
                    "pl_adminname" => $doctor_info->getMemberName(),
                    "pl_points" => $goods_points,
                    "tree_type" => 1,
                    "pl_addtime" => time(),
                    "pl_desc" => "虚拟订单完成时赠送给卖家的积分",
                    "pl_stage" => "虚拟订单完成时赠送卖家的积分",
                    "order_id" => $order_info['order_id']
                );
                $points_log = new \Ypk\Models\PointsLog();
                if ($points_log->save($points_log_data) === false) {
                    \Ypk\Log::record("卖出虚拟产品，添加医护人员member_id={$doctor_info->getMemberId()}的积分日志时失败，数据为：" . json_encode($points_log_data));
                }
            }
        }
    } else {
        return queue_callback(true);
    }
    return queue_callback(true);
}

/**
 * 计算客户圈直荐奖
 * ycg
 *
 * @param array $order_info
 * @return array
 */
function add_member_straight($order_info)
{
    $buyer = \Ypk\Models\Member::findFirst('member_id = ' . $order_info['buyer_id'] . " and member_state=1");
    if (is_null($buyer->getInviterId())) {
        return queue_callback(true);
    }

    $inviter_info = \Ypk\Models\Member::findFirst("member_id=" . $buyer->getInviterId() . " and member_state=1"); //获取推荐人
    if ($inviter_info === false) {
        return queue_callback(true);
    }

    if ($inviter_info->getMemberState() == 0) {
        return queue_callback(true);
    }

    $inviter_tree_level = $inviter_info->getMemberTreeLevel(); //获取推荐人的金银铜级别
    if (empty($inviter_tree_level)) {
        return queue_callback(true);
    }
    //判断是否有直荐奖获取权限
    if (!in_array('straight', getConfig('member_tree_level')[$inviter_tree_level]['has_permission'])) {
        return queue_callback(true);
    }
    $straight_rate = getConfig('member_tree_level')[$inviter_tree_level]['straight_money_base_rate']; //获取直荐奖比例
    $straight_money = $order_info['goods_amount'] * $straight_rate; //计算出直荐奖奖金金额
    if ($inviter_info->save(array("member_straight_money_sum" => ($inviter_info->getMemberStraightMoneySum() + $straight_money))) === false) {
        \Ypk\Log::record("更新邀请人member_id：" . $inviter_info->getMemberId() . "的直荐奖" . $straight_money . "元失败!");
    }
    //写入直荐日志表
    $seller_id = ""; //卖家id
    $seller_name = ""; //卖家名称
    $store_info = \Ypk\Models\Store::findFirst("store_id=" . $order_info['store_id']);
    if ($store_info !== false) {
        $seller_id = $store_info->getMemberId();
        $seller_name = $store_info->getMemberName();
    }
    $member_straight_log = new \Ypk\Models\MemberStraightLog();
    $straight_log_data = array(
        "member_id" => $inviter_info->getMemberId(),
        "buyer_id" => $order_info['buyer_id'],
        "buyer_name" => $order_info['buyer_name'],
        "buy_money" => $order_info['goods_amount'],
        "seller_id" => $seller_id,
        "seller_name" => $seller_name,
        "member_straight_money" => $straight_money,
        "member_tree_type" => 0,
        "add_time" => time(),
        "order_id" => $order_info['order_id']
    );
    if ($member_straight_log->save($straight_log_data) === false) {
        \Ypk\Log::record("添加邀请人member_id：" . $inviter_info->getMemberId() . "的直荐奖日志失败，日志数据为：" . json_encode($straight_log_data));
    }
    return queue_callback(true);
}

/**
 * 计算买家积分
 * ycg
 *
 * @param $order_info
 * @return array
 */
function add_member_points($order_info)
{
    $buyer_id = $order_info['buyer_id']; //购买人id
    $buyer_info = \Ypk\Models\Member::findFirst("member_id=" . $buyer_id . " and member_state=1"); //购买人个人信息
    if ($buyer_info === false) {
        return queue_callback(true);
    }

    if (!empty($order_info['order_type']) && $order_info['order_type'] == 'real_order') {  //表示实物订单
        //找到本订单中所有商品（或服务）的id集合
        $order_goods_list = \Ypk\Models\OrderGoods::find(array("conditions" => "order_id = " . $order_info['order_id']));
        //根据订单计算订单中所有商品（或服务）的积分
        $order_goods_list = $order_goods_list->toArray();
        if (count($order_goods_list) <= 0) {
            return queue_callback(true);
        }
        $goods_ids_array = array();
        foreach ($order_goods_list as $order_goods) {
            $goods_ids_array[] = $order_goods['goods_id'];
        }
        $goods_list = \Ypk\Models\Goods::find(array("conditions" => "goods_id in (" . implode($goods_ids_array) . ")"));
        $goods_list = $goods_list->toArray();
        if (count($goods_list) <= 0) {
            return queue_callback(true);
        }
        $goods_points_list = array();
        foreach ($goods_list as $goods) {
            $goods_points_list[$goods['goods_id']] = $goods['goods_points'];
        }
        $goods_points_sum = 0;
        foreach ($order_goods_list as $order_goods) {
            $goods_points_sum += $order_goods['goods_num'] * $goods_points_list[$order_goods['goods_id']];
        }

        //给普通购买客户添加积分
        if ($buyer_info->save(array("member_points" => ($buyer_info->getMemberPoints() + $goods_points_sum))) === false) {
            \Ypk\Log::record("更新买家member_id={$buyer_info->getMemberId()}的积分{$goods_points_sum}时失败");
        }

        //写入积分日志
        $points_log_data = array(
            "pl_memberid" => $buyer_info->getMemberId(),
            "pl_membername" => $buyer_info->getMemberName(),
            "pl_adminid" => $buyer_info->getMemberId(),
            "pl_adminname" => $buyer_info->getMemberName(),
            "pl_points" => $goods_points_sum,
            "tree_type" => 0,
            "pl_addtime" => time(),
            "pl_desc" => "实物订单完成时赠送的积分",
            "pl_stage" => "实物订单完成时赠送的积分",
            "order_id" => $order_info['order_id']
        );

        $points_log = new \Ypk\Models\PointsLog();
        if ($points_log->save($points_log_data) === false) {
            \Ypk\Log::record("添加买家member_id={$buyer_info->getMemberId()}的积分日志时失败，数据为：" . json_encode($points_log_data));
        }
    } elseif (!empty($order_info['order_type']) && $order_info['order_type'] == 'vr_order') { //表示虚拟订单
        $goods_id = $order_info['goods_id'];
        if (!empty($goods_id)) {
            $goods_info = \Ypk\Models\Goods::findFirst("goods_id=" . $goods_id);
            if ($goods_info !== false) {
                $goods_points = $goods_info->getGoodsPoints(); //获取商品送的积分
                //给普通购买客户添加积分
                if ($buyer_info->save(array("member_points" => ($buyer_info->getMemberPoints() + $goods_points))) === false) {
                    \Ypk\Log::record("更新买家member_id={$buyer_info->getMemberId()}的积分{$goods_points}时失败");
                }

                //写入积分日志
                $points_log_data = array(
                    "pl_memberid" => $buyer_info->getMemberId(),
                    "pl_membername" => $buyer_info->getMemberName(),
                    "pl_adminid" => $buyer_info->getMemberId(),
                    "pl_adminname" => $buyer_info->getMemberName(),
                    "pl_points" => $goods_points,
                    "tree_type" => 0,
                    "pl_addtime" => time(),
                    "pl_desc" => "虚拟订单完成时赠送的积分",
                    "pl_stage" => "虚拟订单完成时赠送的积分",
                    "order_id" => $order_info['order_id']
                );

                $points_log = new \Ypk\Models\PointsLog();
                if ($points_log->save($points_log_data) === false) {
                    \Ypk\Log::record("添加买家member_id={$buyer_info->getMemberId()}的积分日志时失败，数据为：" . json_encode($points_log_data));
                }
            } else {
                return queue_callback(true);
            }
        } else {
            return queue_callback(true);
        }
    } else {
        return queue_callback(true);
    }
    return queue_callback(true);
}

/**
 * 客户圈积分碰撞检测
 * hpf
 *
 * 计算当前会员积分发生变化所引起的它的上级们的积分碰撞检测
 * 购买东西订单完成，买家积分发生变化，引起的它的上级们的积分碰撞检测
 * 积分碰撞由订单完成触发的，不需要进行定时触发，是订单手动完成或者自动完成的内置函数
 * 计算的是当前时刻的积分计算
 *
 * 此方法加入队列执行
 *
 * @param array $order_info 订单信息
 * @return array
 */
function member_points_collision($order_info)
{
    $member_id = $order_info['buyer_id'];
    //积分碰撞当次，应先将要用到的数据全部准备好，计算过程中不再去查数据库，否则计算到中间，数据库数据发生变化，计算就不准确了
    $member = \Ypk\Models\Member::findFirst('member_id = ' . $member_id . " and member_state=1");
    if ($member === false) {
        return queue_callback(false, "member_id = {$member_id} 的会员不存在");
    }

    //得到触发积分碰撞那一刻的的整个用户系统中所有会员和他的积分的整个树的快照,只检测这一刻快照中积分的积分碰撞
    $whole_member_tree = get_whole_member_tree(1, null, 'member_id,member_state,inviter_id,member_tree_id,member_tree_row,member_tree_column,member_points,member_self_used_points_sum,member_left_used_points_sum,member_right_used_points_sum,member_collision_sum_times,member_type_id,member_tree_level');
    if (empty($whole_member_tree)) {
        //整个系统树为空
        return queue_callback(false, "计算member_id = {$member_id} 的会员的积分发生变化引起的积分碰撞检测时查找到的系统全部会员数组为空");
    }
    $max_tree_row = get_array_column_max_value($whole_member_tree, 'member_tree_row');
    if ($max_tree_row === 0) {
        //整个系统树只有第零行
        return queue_callback(false, "计算member_id = {$member_id} 的会员的积分发生变化引起的积分碰撞检测时查找到的系统max_tree_row为零");
    }

    //积分碰撞基数 3000
    $points_base_number = getConfig('points_base_number');
    //每个会员一个月最多可以积分碰撞500次
    $max_collision_times = getConfig('max_collision_times');
    //积分碰撞会员树级别
    $member_tree_level = getConfig('member_tree_level');
    //积分碰撞比例达到2:1的2
    $collision_big_ratio = getConfig('collision_big_ratio');
    //积分碰撞比例达到2:1的1
    $collision_small_ratio = getConfig('collision_small_ratio');

    $curr_check_member_tree_id = $member->getMemberTreeId();
    if (is_null($curr_check_member_tree_id)) {
        //购买者还没有被添加到客户树中，无法查找它的父节点，没法进行积分碰撞检测
        return queue_callback(false, "计算member_id = {$member_id} 的会员的积分发生变化引起的积分碰撞检测时因购买者member_tree_id为空,还没有被添加到客户树中，无法查找它的父节点，没法进行积分碰撞检测");
    }

    while (true) {
        //从买家的父节点开始进行积分碰撞检测，因为买家的积分发生变化，引起上层节点左右树积分发生变化
        $curr_check_member_tree_id = get_one_parent($curr_check_member_tree_id);
        if ($curr_check_member_tree_id === false) {
            //只有平台的父节点才是false，已经没有父节点了，退出
            break;
        }

        $curr_check_member = $whole_member_tree[$curr_check_member_tree_id];
        if ($curr_check_member['member_state'] == 0) {
            //如果该会员被关闭，也不再检测它的积分碰撞，直接检测上一代
            continue;
        }

        //进行积分碰撞的权限验证
        if (!in_array('collision', $member_tree_level[$curr_check_member['member_tree_level']]['has_permission'])) {
            //如果该会员没有积分碰撞的权限，直接检测上一代
            continue;
        }

        //得到还可以积分碰撞几次
        $has_collision_times = $max_collision_times - $curr_check_member['member_collision_sum_times'];

        //碰撞一次赠送多少积分碰撞奖
        $collision_money_base = $member_tree_level[$curr_check_member['member_tree_level']]['collision_money_base'];

        //进行当月积分碰撞次数的验证
        if ($has_collision_times <= 0) {
            //如果该会员积分碰撞已经满了500次，直接检测上一代
            continue;
        }

        //左子树可参与碰撞积分计算
        //得到左子树所有节点id
        $left_tree_child_ids = get_left_tree_child_ids($curr_check_member_tree_id, $max_tree_row);
        if (empty($left_tree_child_ids)) {
            //当前节点的左子到最大行没有id位置，无法进行积分碰撞
            continue;
        }

        //得到左子树所有节点的会员信息
        $left_tree_child_members = get_Array_in_keys($whole_member_tree, $left_tree_child_ids);
        if (empty($left_tree_child_members)) {
            //当前节点的左子树没有任何会员，无法进行积分碰撞
            continue;
        }

        //得到左子树所有节点的总积分
        $left_tree_total_points = get_array_column_sum($left_tree_child_members, 'member_points');
        if ($left_tree_total_points == 0) {
            //左树总积分为零，不能进行积分碰撞
            continue;
        }

        //得到左子树可参与积分碰撞的积分
        $left_can_use_points = $left_tree_total_points - $curr_check_member['member_left_used_points_sum'];
        if ($left_can_use_points <= 0) {
            //左树可参与碰撞的积分为零，不能进行积分碰撞
            continue;
        }

        //右子树可参与碰撞积分计算
        //得到右子树所有节点id
        $right_tree_child_ids = get_right_tree_child_ids($curr_check_member_tree_id, $max_tree_row);
        if (empty($right_tree_child_ids)) {
            //当前节点的右子到最大行没有id位置，无法进行积分碰撞
            continue;
        }

        //得到右子树所有节点的会员信息
        $right_tree_child_members = get_Array_in_keys($whole_member_tree, $right_tree_child_ids);
        if (empty($right_tree_child_members)) {
            //当前节点的右子树没有任何会员，无法进行积分碰撞
            continue;
        }

        //得到右子树所有节点的总积分
        $right_tree_total_points = get_array_column_sum($right_tree_child_members, 'member_points');
        if ($right_tree_total_points == 0) {
            //右树总积分为零，不能进行积分碰撞
            continue;
        }

        //得到右子树可参与积分碰撞的积分
        $right_can_use_points = $right_tree_total_points - $curr_check_member['member_right_used_points_sum'];
        if ($right_can_use_points <= 0) {
            //右树可参与碰撞的积分为零，不能进行积分碰撞
            continue;
        }

        //自己可参与碰撞积分计算
        //得到自己可参与积分碰撞的积分
        $self_can_use_points = $curr_check_member['member_points'] - $curr_check_member['member_self_used_points_sum'];

        $collision_times = 0;
        $self_will_use_points = 0;
        $left_will_use_points = 0;
        $right_will_use_points = 0;

        if ($left_can_use_points >= $points_base_number && $right_can_use_points >= $points_base_number && $left_can_use_points >= $right_can_use_points) {
            //两侧可用于碰撞的积分都大于等于3000,直接把自己的积分数加到较大的一边，然后跟较小积分的那边检测碰撞，如果碰撞失败不再检测小的一边
            //左侧较大
            $max_side = $left_can_use_points + $self_can_use_points;
            $min_side = $right_can_use_points;
            $a = floor($max_side / 3000);
            $b = floor($min_side / 3000);

            //本次碰撞次数
            $collision_times = get_max_collision_times($a, $b);
            if ($collision_times === 0) {
                //不能参与碰撞
                continue;
            }

            if ($collision_times > $has_collision_times) {
                //如果本次可以碰撞的次数比它本月剩下的碰撞次数大，只能碰撞本月剩下的碰撞次数
                $collision_times = $has_collision_times;
            }

            //本次碰撞左子树和自己总共消耗积分数
            $a_will_use_points = $collision_times * ($collision_big_ratio / $collision_small_ratio) * $points_base_number;
            //本次碰撞右子树消耗积分数
            $b_will_use_points = $collision_times * $points_base_number;

            //本次碰撞左子树借用自己多少积分
            $self_will_use_points = 0;
            if ($a_will_use_points > $left_can_use_points) {
                //本次碰撞左侧用掉的积分比左侧拥有的可用积分多，那么才会向自己借积分
                $self_will_use_points = $a_will_use_points - $left_can_use_points;
            }

            //本次碰撞左子树消耗多少积分
            $left_will_use_points = $left_can_use_points;
            if ($a_will_use_points < $left_can_use_points) {
                //本次碰撞左侧用掉的积分比左侧拥有的可用积分少，左侧拥有的积分没消耗完
                $left_will_use_points = $a_will_use_points;
            }

            //本次碰撞右子树消耗多少积分
            $right_will_use_points = $b_will_use_points;

        } elseif ($left_can_use_points >= $points_base_number && $right_can_use_points >= $points_base_number && $left_can_use_points < $right_can_use_points) {
            //两侧可用于碰撞的积分都大于等于3000,直接把自己的积分数加到较大的一边，然后跟较小积分的那边检测碰撞，如果碰撞失败不再检测小的一边
            //右侧较大
            $max_side = $right_can_use_points + $self_can_use_points;
            $min_side = $left_can_use_points;
            $a = floor($max_side / 3000);
            $b = floor($min_side / 3000);

            //本次碰撞次数
            $collision_times = get_max_collision_times($a, $b);
            if ($collision_times === 0) {
                //不能参与碰撞
                continue;
            }

            if ($collision_times > $has_collision_times) {
                //如果本次可以碰撞的次数比它本月剩下的碰撞次数大，只能碰撞本月剩下的碰撞次数
                $collision_times = $has_collision_times;
            }

            //本次碰撞左子树和自己总共消耗积分数
            $a_will_use_points = $collision_times * ($collision_big_ratio / $collision_small_ratio) * $points_base_number;
            //本次碰撞右子树消耗积分数
            $b_will_use_points = $collision_times * $points_base_number;

            //本次碰撞右子树借用自己多少积分
            $self_will_use_points = 0;
            if ($a_will_use_points > $right_can_use_points) {
                //本次碰撞右侧用掉的积分比右侧拥有的可用积分多，那么才会向自己借积分
                $self_will_use_points = $a_will_use_points - $right_can_use_points;
            }

            //本次碰撞右子树消耗多少积分
            $right_will_use_points = $right_can_use_points;
            if ($a_will_use_points < $right_can_use_points) {
                //本次碰撞右侧用掉的积分比右侧拥有的可用积分少，右侧拥有的积分没消耗完
                $right_will_use_points = $a_will_use_points;
            }

            //本次碰撞左子树消耗多少积分
            $left_will_use_points = $b_will_use_points;

        } elseif ($left_can_use_points >= $points_base_number && $right_can_use_points < $points_base_number) {
            //左侧大于等于3000，右侧小于3000大于0，直接把自己的积分数加到小于3000的右侧，检测碰撞
            $max_side = $left_can_use_points;
            $min_side = $right_can_use_points + $self_can_use_points;
            //是否交换过大小边
            $is_exchange_side = false;
            if ($max_side < $min_side) {
                $temp_side = $max_side;
                $max_side = $min_side;
                $min_side = $temp_side;
                $is_exchange_side = true;
            }
            $a = floor($max_side / 3000);
            $b = floor($min_side / 3000);

            //本次碰撞次数
            $collision_times = get_max_collision_times($a, $b);
            if ($collision_times === 0) {
                //不能参与碰撞
                continue;
            }

            if ($collision_times > $has_collision_times) {
                //如果本次可以碰撞的次数比它本月剩下的碰撞次数大，只能碰撞本月剩下的碰撞次数
                $collision_times = $has_collision_times;
            }

            //本次碰撞左子树和自己总共消耗积分数
            $a_will_use_points = $collision_times * ($collision_big_ratio / $collision_small_ratio) * $points_base_number;
            //本次碰撞右子树消耗积分数
            $b_will_use_points = $collision_times * $points_base_number;

            if ($is_exchange_side) {
                $temp_will_use_points = $a_will_use_points;
                $a_will_use_points = $b_will_use_points;
                $b_will_use_points = $temp_will_use_points;
            }

            //本次碰撞右子树借用自己多少积分
            $self_will_use_points = 0;
            if ($b_will_use_points > $right_can_use_points) {
                //本次碰撞右侧用掉的积分比右侧拥有的可用积分多，那么才会向自己借积分
                $self_will_use_points = $b_will_use_points - $right_can_use_points;
            }

            //本次碰撞右子树消耗多少积分
            $right_will_use_points = $right_can_use_points;
            if ($b_will_use_points < $right_can_use_points) {
                //本次碰撞右侧用掉的积分比右侧拥有的可用积分少，右侧拥有的积分没消耗完
                $right_will_use_points = $b_will_use_points;
            }

            //本次碰撞左子树消耗多少积分
            $left_will_use_points = $a_will_use_points;

        } elseif ($left_can_use_points < $points_base_number && $right_can_use_points >= $points_base_number) {
            //右侧大于等于3000，左侧小于3000大于0，直接把自己的积分数加到小于3000的左侧，检测碰撞
            $max_side = $right_can_use_points;
            $min_side = $left_can_use_points + $self_can_use_points;
            //是否交换过大小边
            $is_exchange_side = false;
            if ($max_side < $min_side) {
                $temp_side = $max_side;
                $max_side = $min_side;
                $min_side = $temp_side;
                $is_exchange_side = true;
            }
            $a = floor($max_side / 3000);
            $b = floor($min_side / 3000);

            //本次碰撞次数
            $collision_times = get_max_collision_times($a, $b);
            if ($collision_times === 0) {
                //不能参与碰撞
                continue;
            }

            if ($collision_times > $has_collision_times) {
                //如果本次可以碰撞的次数比它本月剩下的碰撞次数大，只能碰撞本月剩下的碰撞次数
                $collision_times = $has_collision_times;
            }

            //本次碰撞左子树和自己总共消耗积分数
            $a_will_use_points = $collision_times * ($collision_big_ratio / $collision_small_ratio) * $points_base_number;
            //本次碰撞右子树消耗积分数
            $b_will_use_points = $collision_times * $points_base_number;

            if ($is_exchange_side) {
                $temp_will_use_points = $a_will_use_points;
                $a_will_use_points = $b_will_use_points;
                $b_will_use_points = $temp_will_use_points;
            }

            //本次碰撞左子树借用自己多少积分
            $self_will_use_points = 0;
            if ($b_will_use_points > $left_can_use_points) {
                //本次碰撞左侧用掉的积分比左侧拥有的可用积分多，那么才会向自己借积分
                $self_will_use_points = $b_will_use_points - $left_can_use_points;
            }

            //本次碰撞左子树消耗多少积分
            $left_will_use_points = $left_can_use_points;
            if ($b_will_use_points < $left_can_use_points) {
                //本次碰撞左侧用掉的积分比左侧拥有的可用积分少，左侧拥有的积分没消耗完
                $left_will_use_points = $b_will_use_points;
            }

            //本次碰撞右子树消耗多少积分
            $right_will_use_points = $a_will_use_points;

        } elseif ($left_can_use_points < $points_base_number && $right_can_use_points < $points_base_number) {
            //两侧可用于碰撞的积分都小于3000，，不能进行积分碰撞
            continue;
        }

        //存入数据库和积分操作日志表
        $curr_check_member_model = \Ypk\Models\Member::findFirst('member_tree_id = ' . $curr_check_member['member_tree_id']);
        if ($curr_check_member_model === false) {
            continue;
        }

        if ($collision_times <= 0) {
            continue;
        }

        $update_data['member_self_used_points_sum'] = $curr_check_member_model->getMemberSelfUsedPointsSum() + $self_will_use_points;
        $update_data['member_left_used_points_sum'] = $curr_check_member_model->getMemberLeftUsedPointsSum() + $left_will_use_points;
        $update_data['member_right_used_points_sum'] = $curr_check_member_model->getMemberRightUsedPointsSum() + $right_will_use_points;
        $update_data['member_collision_sum_times'] = $curr_check_member_model->getMemberCollisionSumTimes() + $collision_times;
        $update_data['member_collision_sum_money'] = $curr_check_member_model->getMemberCollisionSumMoney() + $collision_times * $collision_money_base;

        if ($curr_check_member_model->save($update_data) === false) {
            \Ypk\Log::record("member {$curr_check_member['member_id']}更新客户树积分碰撞次数和左右去积分消耗时失败，时间：" . date('Y-m-d H:i:s') . "   " . json_encode($update_data));
        }

        $log_data['member_id'] = $curr_check_member['member_id'];
        $log_data['member_tree_id'] = $curr_check_member['member_tree_id'];
        $log_data['member_points'] = $curr_check_member['member_points'];
        $log_data['member_self_used_points'] = $self_will_use_points;
        $log_data['member_left_used_points'] = $left_will_use_points;
        $log_data['member_right_used_points'] = $right_will_use_points;
        $log_data['member_collision_times'] = $collision_times;
        $log_data['member_collision_money'] = $collision_times * $collision_money_base;
        $log_data['member_type_id'] = $curr_check_member['member_type_id'];
        $log_data['collision_log_type'] = 0;
        $log_data['add_time'] = time();
        $log_data['order_id'] = $order_info['order_id'];

        $points_collision_log = new  \Ypk\Models\MemberPointsCollisionLog();
        if ($points_collision_log->save($log_data) === false) {
            \Ypk\Log::record("member {$curr_check_member['member_id']}添加客户树积分碰撞日志时失败，时间：" . date('Y-m-d H:i:s') . "   " . json_encode($log_data));
        }

        //会员得到积分碰撞奖金，那么他的上三代直接推荐人应得到分佣

        $base_commission_money = $collision_times * $collision_money_base;
        $invite_level = 0;
        $curr_commission_member_id = $curr_check_member['inviter_id'];
        while (true) {
            $invite_level++;
            if ($invite_level > 3) {
                //只分佣三级
                break;
            }

            if (is_null($curr_commission_member_id)) {
                //如果邀请人id为空，就把它变成平台
                $curr_commission_member_id = 1;
            }

            $curr_commission_member = \Ypk\Models\Member::findFirst('member_id = ' . $curr_commission_member_id);
            if ($curr_commission_member === false) {
                //平台的推荐人是0，平台没有推荐人，查找member_id=0的会员就返回false
                break;
            }

            if ($curr_commission_member->getMemberState() == 0) {
                //如果该会员被关闭，也不再给他分佣
                continue;
            }

            //进行分佣的权限验证
            if (!in_array('commission', $member_tree_level[$curr_commission_member->getMemberTreeLevel()]['has_permission'])) {
                //如果该会员没有分佣的权限，直接检测上一代
                continue;
            }

            $get_commission_money = $base_commission_money * $member_tree_level[$curr_commission_member->getMemberTreeLevel()]['commission_rate'][$invite_level];
            $new_commission_money = $curr_commission_member->getMemberCommissionMoneySum() + $get_commission_money;
            if ($curr_commission_member->save(array('member_commission_money_sum' => $new_commission_money)) === false) {
                \Ypk\Log::record("member {$curr_commission_member->getMemberId()}更新客户树{$invite_level}级分佣奖金{$new_commission_money}时失败，时间：" . date('Y-m-d H:i:s'));
            }

            $commission_log_data['member_id'] = $curr_commission_member->getMemberId();
            $commission_log_data['member_tree_id'] = $curr_commission_member->getMemberTreeId();
            $commission_log_data['member_tree_commission_money'] = $get_commission_money;
            $commission_log_data['member_commission_level'] = $invite_level;
            $commission_log_data['commission_tree_type'] = 0;
            $commission_log_data['collision_member_id'] = $curr_check_member['member_id'];
            $commission_log_data['collision_times'] = $collision_times;
            $commission_log_data['collision_money'] = $base_commission_money;
            $commission_log_data['add_time'] = time();
            $commission_log_data['order_id'] = $order_info['order_id'];

            $member_commission_log = new \Ypk\Models\MemberCommissionLog();
            if ($member_commission_log->save($commission_log_data) === false) {
                \Ypk\Log::record("member {$curr_commission_member->getMemberId()}添加客户树{$invite_level}级分佣奖金{$get_commission_money}日志时失败，时间：" . date('Y-m-d H:i:s') . "   " . json_encode($commission_log_data));
            }

            $curr_commission_member_id = $curr_commission_member->getInviterId();
        }

        continue;
    }

    return queue_callback(true);
}

/**
 * 医护人员树积分碰撞检测
 * hpf
 *
 * 计算当前会员积分发生变化所引起的它的上级们的积分碰撞检测
 * 卖出服务订单完成，卖家积分发生变化，引起的它的上级们的积分碰撞检测
 * 积分碰撞由卖出服务订单完成触发的，不需要进行定时触发，是订单手动完成或者自动完成的内置函数
 * 计算的是当前时刻的积分计算
 *
 * 此方法加入队列执行
 *
 * @param int $member_id 卖家member_id
 * @param array $order_info 订单信息
 * @return array
 */
function store_points_collision($member_id, $order_info)
{
    //积分碰撞当次，应先将要用到的数据全部准备好，计算过程中不再去查数据库，否则计算到中间，数据库数据发生变化，计算就不准确了
    $member = \Ypk\Models\Member::findFirst('member_id = ' . $member_id);
    if ($member === false) {
        return queue_callback(false, "member_id = {$member_id} 的卖家不存在");
    }

    //得到触发积分碰撞那一刻的的整个卖家系统中所有卖家和他的积分的整个树的快照,只检测这一刻快照中积分的积分碰撞
    $whole_member_tree = get_whole_store_tree(1, null, 'member_id,member_state,inviter_id,store_tree_id,store_tree_row,store_tree_column,store_points,store_self_used_points_sum,store_left_used_points_sum,store_right_used_points_sum,store_collision_sum_times,member_type_id,member_tree_level');
    if (empty($whole_member_tree)) {
        //整个系统树为空
        return queue_callback(false, "计算member_id = {$member_id} 的卖家的积分发生变化引起的积分碰撞检测时查找到的系统全部卖家数组为空");
    }
    $max_tree_row = get_array_column_max_value($whole_member_tree, 'store_tree_row');
    if ($max_tree_row === 0) {
        //整个系统树只有第零行
        return queue_callback(false, "计算member_id = {$member_id} 的卖家的积分发生变化引起的积分碰撞检测时查找到的系统store_tree_row为零");
    }

    //积分碰撞基数 3000
    $points_base_number = getConfig('points_base_number');
    //每个卖家一个月最多可以积分碰撞500次
    $max_collision_times = getConfig('max_collision_times');
    //积分碰撞卖家树级别
    $member_tree_level = getConfig('member_tree_level');
    //积分碰撞比例达到2:1的2
    $collision_big_ratio = getConfig('collision_big_ratio');
    //积分碰撞比例达到2:1的1
    $collision_small_ratio = getConfig('collision_small_ratio');

    $curr_check_store_tree_id = $member->getStoreTreeId();
    if (is_null($curr_check_store_tree_id)) {
        //卖家还没有被添加到医护人员树中，无法查找它的父节点，没法进行积分碰撞检测
        return queue_callback(false, "计算member_id = {$member_id} 的卖家的积分发生变化引起的积分碰撞检测时因购卖家store_tree_id为空,还没有被添加到医务人员树中，无法查找它的父节点，没法进行积分碰撞检测");
    }

    while (true) {
        //从卖家的父节点开始进行积分碰撞检测，因为卖家的积分发生变化，引起上层节点左右树积分发生变化
        $curr_check_store_tree_id = get_one_parent($curr_check_store_tree_id);
        if ($curr_check_store_tree_id === false) {
            //只有平台的父节点才是false，已经没有父节点了，退出
            break;
        }

        $curr_check_member = $whole_member_tree[$curr_check_store_tree_id];
        if ($curr_check_member['member_state'] == 0) {
            //如果该卖家被关闭，也不再检测它的积分碰撞，直接检测上一代
            continue;
        }

        //进行积分碰撞的权限验证
        if (!in_array('collision', $member_tree_level[$curr_check_member['member_tree_level']]['has_permission'])) {
            //如果该卖家没有积分碰撞的权限，直接检测上一代
            continue;
        }

        //得到还可以积分碰撞几次
        $has_collision_times = $max_collision_times - $curr_check_member['store_collision_sum_times'];

        //碰撞一次赠送多少积分碰撞奖
        $collision_money_base = $member_tree_level[$curr_check_member['member_tree_level']]['collision_money_base'];

        //进行当月积分碰撞次数的验证
        if ($has_collision_times <= 0) {
            //如果该卖家积分碰撞已经满了500次，直接检测上一代
            continue;
        }

        //左子树可参与碰撞积分计算
        //得到左子树所有节点id
        $left_tree_child_ids = get_left_tree_child_ids($curr_check_store_tree_id, $max_tree_row);
        if (empty($left_tree_child_ids)) {
            //当前节点的左子到最大行没有id位置，无法进行积分碰撞
            continue;
        }

        //得到左子树所有节点的卖家信息
        $left_tree_child_members = get_Array_in_keys($whole_member_tree, $left_tree_child_ids, 'store_tree_id');
        if (empty($left_tree_child_members)) {
            //当前节点的左子树没有任何卖家，无法进行积分碰撞
            continue;
        }

        //得到左子树所有节点的总积分
        $left_tree_total_points = get_array_column_sum($left_tree_child_members, 'store_points');
        if ($left_tree_total_points == 0) {
            //左树总积分为零，不能进行积分碰撞
            continue;
        }

        //得到左子树可参与积分碰撞的积分
        $left_can_use_points = $left_tree_total_points - $curr_check_member['store_left_used_points_sum'];
        if ($left_can_use_points <= 0) {
            //左树可参与碰撞的积分为零，不能进行积分碰撞
            continue;
        }

        //右子树可参与碰撞积分计算
        //得到右子树所有节点id
        $right_tree_child_ids = get_right_tree_child_ids($curr_check_store_tree_id, $max_tree_row);
        if (empty($right_tree_child_ids)) {
            //当前节点的右子到最大行没有id位置，无法进行积分碰撞
            continue;
        }

        //得到右子树所有节点的卖家信息
        $right_tree_child_members = get_Array_in_keys($whole_member_tree, $right_tree_child_ids, 'store_tree_id');
        if (empty($right_tree_child_members)) {
            //当前节点的右子树没有任何卖家，无法进行积分碰撞
            continue;
        }

        //得到右子树所有节点的总积分
        $right_tree_total_points = get_array_column_sum($right_tree_child_members, 'store_points');
        if ($right_tree_total_points == 0) {
            //右树总积分为零，不能进行积分碰撞
            continue;
        }

        //得到右子树可参与积分碰撞的积分
        $right_can_use_points = $right_tree_total_points - $curr_check_member['store_right_used_points_sum'];
        if ($right_can_use_points <= 0) {
            //右树可参与碰撞的积分为零，不能进行积分碰撞
            continue;
        }

        //自己可参与碰撞积分计算
        //得到自己可参与积分碰撞的积分
        $self_can_use_points = $curr_check_member['store_points'] - $curr_check_member['store_self_used_points_sum'];

        $collision_times = 0;
        $self_will_use_points = 0;
        $left_will_use_points = 0;
        $right_will_use_points = 0;

        if ($left_can_use_points >= $points_base_number && $right_can_use_points >= $points_base_number && $left_can_use_points >= $right_can_use_points) {
            //两侧可用于碰撞的积分都大于等于3000,直接把自己的积分数加到较大的一边，然后跟较小积分的那边检测碰撞，如果碰撞失败不再检测小的一边
            //左侧较大
            $max_side = $left_can_use_points + $self_can_use_points;
            $min_side = $right_can_use_points;
            $a = floor($max_side / 3000);
            $b = floor($min_side / 3000);

            //本次碰撞次数
            $collision_times = get_max_collision_times($a, $b);
            if ($collision_times === 0) {
                //不能参与碰撞
                continue;
            }

            if ($collision_times > $has_collision_times) {
                //如果本次可以碰撞的次数比它本月剩下的碰撞次数大，只能碰撞本月剩下的碰撞次数
                $collision_times = $has_collision_times;
            }

            //本次碰撞左子树和自己总共消耗积分数
            $a_will_use_points = $collision_times * ($collision_big_ratio / $collision_small_ratio) * $points_base_number;
            //本次碰撞右子树消耗积分数
            $b_will_use_points = $collision_times * $points_base_number;

            //本次碰撞左子树借用自己多少积分
            $self_will_use_points = 0;
            if ($a_will_use_points > $left_can_use_points) {
                //本次碰撞左侧用掉的积分比左侧拥有的可用积分多，那么才会向自己借积分
                $self_will_use_points = $a_will_use_points - $left_can_use_points;
            }

            //本次碰撞左子树消耗多少积分
            $left_will_use_points = $left_can_use_points;
            if ($a_will_use_points < $left_can_use_points) {
                //本次碰撞左侧用掉的积分比左侧拥有的可用积分少，左侧拥有的积分没消耗完
                $left_will_use_points = $a_will_use_points;
            }

            //本次碰撞右子树消耗多少积分
            $right_will_use_points = $b_will_use_points;

        } elseif ($left_can_use_points >= $points_base_number && $right_can_use_points >= $points_base_number && $left_can_use_points < $right_can_use_points) {
            //两侧可用于碰撞的积分都大于等于3000,直接把自己的积分数加到较大的一边，然后跟较小积分的那边检测碰撞，如果碰撞失败不再检测小的一边
            //右侧较大
            $max_side = $right_can_use_points + $self_can_use_points;
            $min_side = $left_can_use_points;
            $a = floor($max_side / 3000);
            $b = floor($min_side / 3000);

            //本次碰撞次数
            $collision_times = get_max_collision_times($a, $b);
            if ($collision_times === 0) {
                //不能参与碰撞
                continue;
            }

            if ($collision_times > $has_collision_times) {
                //如果本次可以碰撞的次数比它本月剩下的碰撞次数大，只能碰撞本月剩下的碰撞次数
                $collision_times = $has_collision_times;
            }

            //本次碰撞左子树和自己总共消耗积分数
            $a_will_use_points = $collision_times * ($collision_big_ratio / $collision_small_ratio) * $points_base_number;
            //本次碰撞右子树消耗积分数
            $b_will_use_points = $collision_times * $points_base_number;

            //本次碰撞右子树借用自己多少积分
            $self_will_use_points = 0;
            if ($a_will_use_points > $right_can_use_points) {
                //本次碰撞右侧用掉的积分比右侧拥有的可用积分多，那么才会向自己借积分
                $self_will_use_points = $a_will_use_points - $right_can_use_points;
            }

            //本次碰撞右子树消耗多少积分
            $right_will_use_points = $right_can_use_points;
            if ($a_will_use_points < $right_can_use_points) {
                //本次碰撞右侧用掉的积分比右侧拥有的可用积分少，右侧拥有的积分没消耗完
                $right_will_use_points = $a_will_use_points;
            }

            //本次碰撞左子树消耗多少积分
            $left_will_use_points = $b_will_use_points;

        } elseif ($left_can_use_points >= $points_base_number && $right_can_use_points < $points_base_number) {
            //左侧大于等于3000，右侧小于3000大于0，直接把自己的积分数加到小于3000的右侧，检测碰撞
            $max_side = $left_can_use_points;
            $min_side = $right_can_use_points + $self_can_use_points;
            //是否交换过大小边
            $is_exchange_side = false;
            if ($max_side < $min_side) {
                $temp_side = $max_side;
                $max_side = $min_side;
                $min_side = $temp_side;
                $is_exchange_side = true;
            }
            $a = floor($max_side / 3000);
            $b = floor($min_side / 3000);

            //本次碰撞次数
            $collision_times = get_max_collision_times($a, $b);
            if ($collision_times === 0) {
                //不能参与碰撞
                continue;
            }

            if ($collision_times > $has_collision_times) {
                //如果本次可以碰撞的次数比它本月剩下的碰撞次数大，只能碰撞本月剩下的碰撞次数
                $collision_times = $has_collision_times;
            }

            //本次碰撞左子树和自己总共消耗积分数
            $a_will_use_points = $collision_times * ($collision_big_ratio / $collision_small_ratio) * $points_base_number;
            //本次碰撞右子树消耗积分数
            $b_will_use_points = $collision_times * $points_base_number;

            if ($is_exchange_side) {
                $temp_will_use_points = $a_will_use_points;
                $a_will_use_points = $b_will_use_points;
                $b_will_use_points = $temp_will_use_points;
            }

            //本次碰撞右子树借用自己多少积分
            $self_will_use_points = 0;
            if ($b_will_use_points > $right_can_use_points) {
                //本次碰撞右侧用掉的积分比右侧拥有的可用积分多，那么才会向自己借积分
                $self_will_use_points = $b_will_use_points - $right_can_use_points;
            }

            //本次碰撞右子树消耗多少积分
            $right_will_use_points = $right_can_use_points;
            if ($b_will_use_points < $right_can_use_points) {
                //本次碰撞右侧用掉的积分比右侧拥有的可用积分少，右侧拥有的积分没消耗完
                $right_will_use_points = $b_will_use_points;
            }

            //本次碰撞左子树消耗多少积分
            $left_will_use_points = $a_will_use_points;

        } elseif ($left_can_use_points < $points_base_number && $right_can_use_points >= $points_base_number) {
            //右侧大于等于3000，左侧小于3000大于0，直接把自己的积分数加到小于3000的左侧，检测碰撞
            $max_side = $right_can_use_points;
            $min_side = $left_can_use_points + $self_can_use_points;
            //是否交换过大小边
            $is_exchange_side = false;
            if ($max_side < $min_side) {
                $temp_side = $max_side;
                $max_side = $min_side;
                $min_side = $temp_side;
                $is_exchange_side = true;
            }
            $a = floor($max_side / 3000);
            $b = floor($min_side / 3000);

            //本次碰撞次数
            $collision_times = get_max_collision_times($a, $b);
            if ($collision_times === 0) {
                //不能参与碰撞
                continue;
            }

            if ($collision_times > $has_collision_times) {
                //如果本次可以碰撞的次数比它本月剩下的碰撞次数大，只能碰撞本月剩下的碰撞次数
                $collision_times = $has_collision_times;
            }

            //本次碰撞左子树和自己总共消耗积分数
            $a_will_use_points = $collision_times * ($collision_big_ratio / $collision_small_ratio) * $points_base_number;
            //本次碰撞右子树消耗积分数
            $b_will_use_points = $collision_times * $points_base_number;

            if ($is_exchange_side) {
                $temp_will_use_points = $a_will_use_points;
                $a_will_use_points = $b_will_use_points;
                $b_will_use_points = $temp_will_use_points;
            }

            //本次碰撞左子树借用自己多少积分
            $self_will_use_points = 0;
            if ($b_will_use_points > $left_can_use_points) {
                //本次碰撞左侧用掉的积分比左侧拥有的可用积分多，那么才会向自己借积分
                $self_will_use_points = $b_will_use_points - $left_can_use_points;
            }

            //本次碰撞左子树消耗多少积分
            $left_will_use_points = $left_can_use_points;
            if ($b_will_use_points < $left_can_use_points) {
                //本次碰撞左侧用掉的积分比左侧拥有的可用积分少，左侧拥有的积分没消耗完
                $left_will_use_points = $b_will_use_points;
            }

            //本次碰撞右子树消耗多少积分
            $right_will_use_points = $a_will_use_points;

        } elseif ($left_can_use_points < $points_base_number && $right_can_use_points < $points_base_number) {
            //两侧可用于碰撞的积分都小于3000，，不能进行积分碰撞
            continue;
        }

        //存入数据库和积分操作日志表
        $curr_check_member_model = \Ypk\Models\Member::findFirst('store_tree_id = ' . $curr_check_member['store_tree_id']);
        if ($curr_check_member_model === false) {
            continue;
        }

        if ($collision_times <= 0) {
            continue;
        }

        $update_data['store_self_used_points_sum'] = $curr_check_member_model->getStoreSelfUsedPointsSum() + $self_will_use_points;
        $update_data['store_left_used_points_sum'] = $curr_check_member_model->getStoreLeftUsedPointsSum() + $left_will_use_points;
        $update_data['store_right_used_points_sum'] = $curr_check_member_model->getStoreRightUsedPointsSum() + $right_will_use_points;
        $update_data['store_collision_sum_times'] = $curr_check_member_model->getStoreCollisionSumTimes() + $collision_times;
        $update_data['store_collision_sum_money'] = $curr_check_member_model->getStoreCollisionSumMoney() + $collision_times * $collision_money_base;
        if ($curr_check_member_model->save($update_data) === false) {
            \Ypk\Log::record("member {$curr_check_member['member_id']}更新医务人员树积分碰撞次数和左右去积分消耗时失败，时间：" . date('Y-m-d H:i:s') . "   " . json_encode($update_data));
        }

        $log_data['member_id'] = $curr_check_member['member_id'];
        $log_data['store_tree_id'] = $curr_check_member['store_tree_id'];
        $log_data['store_points'] = $curr_check_member['store_points'];
        $log_data['store_self_used_points'] = $self_will_use_points;
        $log_data['store_left_used_points'] = $left_will_use_points;
        $log_data['store_right_used_points'] = $right_will_use_points;
        $log_data['store_collision_times'] = $collision_times;
        $log_data['store_collision_money'] = $collision_times * $collision_money_base;
        $log_data['member_type_id'] = $curr_check_member['member_type_id'];
        $log_data['collision_log_type'] = 1;
        $log_data['add_time'] = time();
        $log_data['order_id'] = $order_info['order_id'];

        $points_collision_log = new  \Ypk\Models\MemberPointsCollisionLog();
        if ($points_collision_log->save($log_data) === false) {
            \Ypk\Log::record("member {$curr_check_member['member_id']}添加医务人员树积分碰撞日志时失败，时间：" . date('Y-m-d H:i:s') . "   " . json_encode($log_data));
        }

        //卖家得到积分碰撞奖金，那么他的上三代直接推荐人应得到分佣
        $base_commission_money = $collision_times * $collision_money_base;
        $invite_level = 0;
        $curr_commission_member_id = $curr_check_member['inviter_id'];
        while (true) {
            $invite_level++;
            if ($invite_level > 3) {
                //只分佣三级
                break;
            }

            if (is_null($curr_commission_member_id)) {
                //如果邀请人id为空，就把它变成平台
                $curr_commission_member_id = 1;
            }

            $curr_commission_member = \Ypk\Models\Member::findFirst('member_id = ' . $curr_commission_member_id);
            if ($curr_commission_member === false) {
                //平台的推荐人是0，平台没有推荐人，查找member_id=0的会员就返回false
                break;
            }

            if ($curr_commission_member->getMemberState() == 0) {
                //如果该卖家被关闭，也不再给他分佣
                continue;
            }

            //进行分佣的权限验证
            if (!in_array('commission', $member_tree_level[$curr_commission_member->getMemberTreeLevel()]['has_permission'])) {
                //如果该卖家没有分佣的权限，直接检测上一代
                continue;
            }

            $get_commission_money = $base_commission_money * $member_tree_level[$curr_commission_member->getMemberTreeLevel()]['commission_rate'][$invite_level];
            $new_commission_money = $curr_commission_member->getStoreCommissionMoneySum() + $get_commission_money;
            if ($curr_commission_member->save(array('store_commission_money_sum' => $new_commission_money)) === false) {
                \Ypk\Log::record("member {$curr_commission_member->getMemberId()}更新医护人员树{$invite_level}级分佣奖金{$new_commission_money}时失败，时间：" . date('Y-m-d H:i:s'));
            }

            $commission_log_data['member_id'] = $curr_commission_member->getMemberId();
            $commission_log_data['store_tree_id'] = $curr_commission_member->getStoreTreeId();
            $commission_log_data['store_tree_commission_money'] = $get_commission_money;
            $commission_log_data['store_commission_level'] = $invite_level;
            $commission_log_data['commission_tree_type'] = 1;
            $commission_log_data['collision_member_id'] = $curr_check_member['member_id'];
            $commission_log_data['collision_times'] = $collision_times;
            $commission_log_data['collision_money'] = $base_commission_money;
            $commission_log_data['add_time'] = time();
            $commission_log_data['order_id'] = $order_info['order_id'];
            $member_commission_log = new \Ypk\Models\MemberCommissionLog();
            if ($member_commission_log->save($commission_log_data) === false) {
                \Ypk\Log::record("member {$curr_commission_member->getMemberId()}添加医护人员树{$invite_level}级分佣奖金{$get_commission_money}日志时失败，时间：" . date('Y-m-d H:i:s') . "   " . json_encode($commission_log_data));
            }

            $curr_commission_member_id = $curr_commission_member->getInviterId();
        }

        continue;
    }

    return queue_callback(true);
}

/**
 * 积分和四大奖金计算
 *
 * 必须加入队列执行
 * @param array $order_info
 * @return array
 */
function update_points_and_reward($order_info)
{
    if (!is_array($order_info) || empty($order_info)) {
        return queue_callback(true);
    }

    if (empty($order_info['buyer_id'])) {
        return queue_callback(true);
    }

    if (!empty($order_info['order_type']) && $order_info['order_type'] == "real_order") {  //表示是实物订单
        //判断实物订单是否存在，或者是否已经完成了交易
        $order_model = \Ypk\Models\Orders::findFirst("order_id=" . $order_info['order_id']);
        if ($order_model === false || ($order_model->getOrderState() != ORDER_STATE_SUCCESS && $order_model->getOrderState() != ORDER_AUTO_RECEIVE_DAY)) {
            return queue_callback(true);
        }

        $order_compute_log = \Ypk\Models\OrderComputeLog::findFirst("order_id=" . $order_info['order_id'] . " and order_type=1");
        if ($order_compute_log !== false) {
            return queue_callback(true);
        }
        $order_compute_log = new \Ypk\Models\OrderComputeLog();
        if ($order_compute_log->save(array('order_id' => $order_info['order_id'], 'order_type' => 1)) === false) {
            \Ypk\Log::record("实物订单{$order_info['order_id']}的四大计算没有开始计算，数据是：" . json_encode($order_info));
            return queue_callback(true);
        }
    } elseif (!empty($order_info['order_type']) && $order_info['order_type'] == "vr_order") { //表示是虚拟订单
        //判断虚拟订单是否存在
        $vr_order_model = \Ypk\Models\VrOrder::findFirst("order_id=" . $order_info['order_id']);
        if ($vr_order_model === false || $vr_order_model->getOrderState() != ORDER_STATE_SUCCESS) {
            return queue_callback(true);
        }

        $order_compute_log = \Ypk\Models\OrderComputeLog::findFirst("order_id=" . $order_info['order_id'] . " and order_type=0");
        if ($order_compute_log !== false) {
            return queue_callback(true);
        }
        $order_compute_log = new \Ypk\Models\OrderComputeLog();
        if ($order_compute_log->save(array('order_id' => $order_info['order_id'], 'order_type' => 0)) === false) {
            \Ypk\Log::record("虚拟订单{$order_info['order_id']}的四大计算没有开始计算，数据是：" . json_encode($order_info));
            return queue_callback(true);
        }
    } else {
        \Ypk\Log::record("调用四大计算时，订单类型不匹配，数据是：" . json_encode($order_info));
        return queue_callback(true);
    }


    //计算买家直荐奖
    add_member_straight($order_info);
    //计算买家积分
    add_member_points($order_info);
    //计算买家积分碰撞奖和分佣奖金
    member_points_collision($order_info);
    //更新买家金银铜级别
    $update_member_tree_level_params = array(
        "member_id" => $order_info['buyer_id'],
        "member_name" => $order_info['buyer_name'],
        "money" => $order_info['order_amount'],
        "update_type" => 0,
    );
    update_member_tree_level($update_member_tree_level_params);

    if (empty($order_info['buyer_id'])) {
        return queue_callback(true);
    }

    $store = \Ypk\Models\Store::findFirst('store_id = ' . $order_info['store_id']);
    if ($store === false || $store->getMemberId() <= 0) {
        return queue_callback(true);
    }
    $seller = \Ypk\Models\Member::findFirst('member_id = ' . $store->getMemberId() . " and member_state=1");
    //2判断卖家是客户还是医生，如果是医生，计算下面四个奖金
    if ($seller === false || $seller->getMemberTypeId() <= 1) {
        return queue_callback(true);
    }

    //计算卖家分利奖和直荐奖
    add_doctor_share_benefits($order_info);
    //计算卖家积分
    add_doctor_points($order_info);
    //计算卖家积分碰撞奖和分佣奖金
    store_points_collision($seller->getMemberId(), $order_info);

    return queue_callback(true);
}

/**
 * 根据tree_id集合获取member_id集合
 * @param string $child_treeIds
 * @param $type 0表示客户圈  1表示医护圈
 * @return string
 */
function get_member_ids($child_treeIds, $type = 0)
{
    $member_ids = "";
    if (!empty($child_treeIds)) {
        if ($type == 0) {
            $member_list = \Ypk\Models\Member::find(array("conditions" => "member_tree_id in (" . implode(',', $child_treeIds) . ")"));
        } else {
            $member_list = \Ypk\Models\Member::find(array("conditions" => "store_tree_id in (" . implode(',', $child_treeIds) . ")"));
        }

        if (count($member_list) > 0) {
            $member_list = $member_list->toArray();
            foreach ($member_list as $member) {
                if (empty($member_ids)) {
                    $member_ids .= $member['member_id'];
                } else {
                    $member_ids .= ("," . $member['member_id']);
                }
            }
        }
    }
    return $member_ids;
}

/**
 * 订单支付完成时，处理服务和聊天卡订单（已过时）
 * @param array $order_info
 */
function change_order_state($order_info)
{
    //判断订单商品是否包含聊天卡，如果是则把购买聊天卡写入“member_chat_card”表
    if ($order_info && !empty($order_info)) {
        $order_id = $order_info['order_id']; //获取订单id
        if (!empty($order_id)) {
            $order_goods_list = \Ypk\Models\OrderGoods::find("order_id=" . $order_id);
            if (count($order_goods_list) > 0) {
                $order_goods_list = $order_goods_list->toArray();
                $is_vr_flag = false;
                foreach ($order_goods_list as $order_goods) {
                    $goods_info = \Ypk\Models\Goods::findFirst("goods_id=" . $order_goods['goods_id']); //商品实体信息
                    $store_info = \Ypk\Models\Store::findFirst("store_id=" . $order_info['store_id']); //店铺实体信息
                    if ($goods_info && $goods_info->getGcId1() == 1076) { //表示购买的是聊天卡
                        $is_vr_flag = true;
                        $member_chat_card = new \Ypk\Models\MemberChatCard();
                        $member_chat_card_array = array(
                            'member_id' => $order_info['buyer_id'],
                            'order_id' => $order_info['order_id'],
                            'doctor_id' => $store_info->getMemberId(),
                            'is_use' => 0,
                            'how_lang_time' => intval($goods_info->getSpecName()),
                            'add_time' => time(),
                            'card_type' => 0
                        );

                        if ($member_chat_card->save($member_chat_card_array) == false) {
                            \Ypk\Log::record("客户购买聊天卡时，插入member_chat_card表时失败，数据是：" . json_encode($member_chat_card_array));
                        }

                        $doctor_chat_card = new \Ypk\Models\MemberChatCard();
                        $doctor_chat_card_array = array(
                            'member_id' => $store_info->getMemberId(),
                            'order_id' => $order_info['order_id'],
                            'doctor_id' => $order_info['buyer_id'],
                            'is_use' => 0,
                            'how_lang_time' => intval($goods_info->getSpecName()) + (3600 * 1),
                            'add_time' => time(),
                            'card_type' => 1
                        );
                        if ($doctor_chat_card->save($doctor_chat_card_array) == false) {
                            \Ypk\Log::record("医生获取聊天卡时，插入member_chat_card表时失败，数据是：" . json_encode($doctor_chat_card_array));
                        }
                        $order_model = \Ypk\Models\Orders::findFirst("order_id=" . $order_id);
                        if ($order_model) {
                            $order_model->save(array('order_state' => ORDER_STATE_SUCCESS)); //如果购买的是聊天卡，直接把订单状态改为“已收货”
                        }
                        //调用四大计算方法
                        \Ypk\QueueClient::push('update_points_and_reward', $order_info);
                    }
                    if ($goods_info && $goods_info->getGcId1() == 1073) { //表示购买的是医疗服务
                        $is_vr_flag = true;
                        $number_arr = array();
                        for ($i = 0; $i < $order_goods["goods_num"]; $i++) {
                            $min_id = \Ypk\Models\MemberBuyServiceNum::minimum(array("goods_id = {$goods_info->getGoodsId()} and start_time = {$goods_info->getDoctorServiceStartTime()} and end_time = {$goods_info->getDoctorServiceEndTime()} and is_use = 0", 'column' => 'id'));
                            $member_buy_service_num_info = \Ypk\Models\MemberBuyServiceNum::findFirst("id=" . $min_id);
                            if ($member_buy_service_num_info !== false) {
                                $member_buy_service_num_array = array(
                                    'buyer_id' => $order_info['buyer_id'],
                                    'is_use' => 1,
                                    'add_time' => time()
                                );
                                if ($member_buy_service_num_info->save($member_buy_service_num_array) == false) {
                                    \Ypk\Log::record("购买医疗服务时，插入member_buy_service_num表时失败，获取的编号是{$min_id}，数据是：" . json_encode($member_buy_service_num_array));
                                }
                            }
                            $number_arr[] = $member_buy_service_num_info->getBuyerNumber() . '号';
                        } //for循环结束

                        //如果购买的是医疗服务，则把订单状态直接改为“已发货”
                        $order_model = \Ypk\Models\Orders::findFirst("order_id=" . $order_id);
                        if ($order_model) {
                            $order_model->save(array('order_state' => ORDER_STATE_SEND)); //如果购买的是服务，直接把订单状态改为“已收货”
                        }

                        //向用户发送手机短信
                        $member_info = \Ypk\Models\Member::findFirst("member_id=" . $order_info['buyer_id']); //买家个人信息
                        $doctor_info = \Ypk\Models\Member::findFirst("member_id=" . $store_info->getMemberId()); //医生个人信息
                        if ($member_info !== false && !empty($member_info->getMemberMobile())) {
                            $send = new \Ypk\Sms();
                            $doctor_name = "该";
                            if ($doctor_info !== false) {
                                $doctor_name = $doctor_info->getMemberName();
                            }
                            $msg_str = '欢迎您使用逸陪康在线医疗服务平台，您已成功购买' . $doctor_name . '医生的' . $goods_info->getGoodsName() . '服务，服务时间是：' . date('Y-m-d H:i:s', $goods_info->getDoctorServiceStartTime()) . '-' . date('Y-m-d H:i:s', $goods_info->getDoctorServiceEndTime()) . '，地点是：' . $goods_info->getHispitalAddress() . $goods_info->getDepartAddress() . '，您的编号是：' . implode('、', $number_arr) . '。【' . $goods_info->getGoodsName() . '】';
                            //$send->send($member_info->getMemberMobile(), '您已成功购买"' . $goods_info->getGoodsName() . '"服务，编号是：' . implode('、', $number_arr) . '【' . $goods_info->getGoodsName() . '】');
                            $send->send($member_info->getMemberMobile(), $msg_str);
                        }
                    }
                }
            }
        }
    }
}

/**
 * 订单支付完成时，处理虚拟订单中的服务订单和聊天卡订单
 * @param array $vr_order_info
 */
function change_vr_order_state($vr_order_info)
{
    if ($vr_order_info && !empty($vr_order_info)) {
        $goods_info = \Ypk\Models\Goods::findFirst("goods_id=" . $vr_order_info['goods_id']); //商品实体信息
        $store_info = \Ypk\Models\Store::findFirst("store_id=" . $vr_order_info['store_id']); //店铺实体信息
        if ($goods_info !== false) {
            if ($goods_info->getGcId1() == 1073) { //表示购买的是医疗服务

                //添加服务的购买记录
                $goods_buy_record_model=new \Ypk\Models\GoodsBuyRecord();
                $goods_buy_record_model->setBuyerId($vr_order_info['buyer_id']);
                $goods_buy_record_model->setGoodsId($goods_info->getGoodsId());
                $goods_buy_record_model->setAddTime(time());
                $goods_buy_record_model->save();

                $number_arr = array();
                for ($i = 0; $i < $vr_order_info["goods_num"]; $i++) {
                    $min_id = \Ypk\Models\MemberBuyServiceNum::minimum(array("goods_id = {$goods_info->getGoodsId()} and start_time = {$goods_info->getDoctorServiceStartTime()} and end_time = {$goods_info->getDoctorServiceEndTime()} and is_use = 0", 'column' => 'id'));
                    if(empty($min_id))
                    {
                        continue;
                    }
                    $member_buy_service_num_info = \Ypk\Models\MemberBuyServiceNum::findFirst("id=" . $min_id);
                    if ($member_buy_service_num_info !== false) {
                        $member_buy_service_num_array = array(
                            'buyer_id' => $vr_order_info['buyer_id'],
                            'is_use' => 1,
                            'add_time' => time(),
                            'order_sn' => $vr_order_info["order_sn"]
                        );
                        if ($member_buy_service_num_info->save($member_buy_service_num_array) == false) {
                            \Ypk\Log::record("购买医疗服务时，插入member_buy_service_num表时失败，获取的编号是{$min_id}，数据是：" . json_encode($member_buy_service_num_array));
                        }
                    }
                    $number_arr[] = $member_buy_service_num_info->getBuyerNumber() . '号';
                } //for循环结束

                //向用户发送手机短信
				if(empty($number_arr)){
                    $number_arr[]=1;
                }
                $member_info = \Ypk\Models\Member::findFirst("member_id=" . $vr_order_info['buyer_id']); //买家个人信息
                $doctor_info = \Ypk\Models\Member::findFirst("member_id=" . $store_info->getMemberId()); //医生个人信息
                if ($member_info !== false && !empty($member_info->getMemberMobile())) {
                    $send = new \Ypk\Sms();
                    $doctor_name = "该";
                    if ($doctor_info !== false) {
                        $doctor_name = $doctor_info->getMemberName();
                    }
                    $msg_str = '欢迎您使用逸陪康在线医疗服务平台，您已成功购买' . $doctor_name . '医生的' . $goods_info->getGoodsName() . '服务，服务时间是：' . date('Y-m-d H:i:s', $goods_info->getDoctorServiceStartTime()) . '-' . date('Y-m-d H:i:s', $goods_info->getDoctorServiceEndTime()) . '，地点是：' . $goods_info->getHispitalAddress() . $goods_info->getDepartAddress() . '，您的编号是：' . implode('、', $number_arr) . '。【' . $goods_info->getGoodsName() . '】';
                    $send->send($member_info->getMemberMobile(), $msg_str);
                }
            }
            if ($goods_info->getGcId1() == 1076) { //表示购买的是聊天卡
                $vr_order_code = \Ypk\Models\VrOrderCode::findFirst("order_id=" . $vr_order_info['order_id']);
                if ($vr_order_code === false) {
                    return;
                }

                $member_chat_card = new \Ypk\Models\MemberChatCard();
                $member_chat_card_array = array(
                    'member_id' => $vr_order_info['buyer_id'],
                    'order_id' => $vr_order_info['order_id'],
                    'doctor_id' => $store_info->getMemberId(),
                    'is_use' => 0,
                    'how_lang_time' => intval($goods_info->getSpecName()),
                    'add_time' => time(),
                    'card_type' => 0,
                    'chat_card_start_time' => $goods_info->getDoctorServiceStartTime(),
                    'chat_card_end_time' => $goods_info->getDoctorServiceEndTime(),
                    'exchange_code' => $vr_order_code->getVrCode()
                );

                if ($member_chat_card->save($member_chat_card_array) == false) {
                    \Ypk\Log::record("客户购买聊天卡时，插入member_chat_card表时失败，数据是：" . json_encode($member_chat_card_array));
                }

                $doctor_chat_card = new \Ypk\Models\MemberChatCard();
                $doctor_chat_card_array = array(
                    'member_id' => $store_info->getMemberId(),
                    'order_id' => $vr_order_info['order_id'],
                    'doctor_id' => $vr_order_info['buyer_id'],
                    'is_use' => 0,
                    'how_lang_time' => intval($goods_info->getSpecName()) + (3600 * 1),
                    'add_time' => time(),
                    'card_type' => 1,
                    'chat_card_start_time' => $goods_info->getDoctorServiceStartTime(),
                    'chat_card_end_time' => intval($goods_info->getDoctorServiceEndTime()) + (3600 * 1),
                    'exchange_code' => $vr_order_code->getVrCode()
                );
                if ($doctor_chat_card->save($doctor_chat_card_array) == false) {
                    \Ypk\Log::record("医生获取聊天卡时，插入member_chat_card表时失败，数据是：" . json_encode($doctor_chat_card_array));
                }
            }
        }
    }
}

/**
 * 检测医务人员资料是否完整
 * @param $member_id
 * @return bool
 */
function check_info_complete($member_id)
{
    $flag = true;
    if (!empty($member_id)) {
        $store_joinc_info = \Ypk\Models\StoreJoinin::findFirst("member_id=" . $member_id);
        if ($store_joinc_info !== false) {
            $store_joinc_info = $store_joinc_info->toArray();
            if (empty($store_joinc_info['business_sphere'])) { //判断真实姓名是否完整
                $flag = false;
            }
            if (empty($store_joinc_info['business_departments'])) { //判断科室是否完整
                $flag = false;
            }
            if (empty($store_joinc_info['business_professional'])) { //判断职称是否完整
                $flag = false;
            }
            if (empty($store_joinc_info['business_lockHospital'])) { //判断定点医院是否完整
                $flag = false;
            }
            if (empty($store_joinc_info['company_address'])) { //判断地区是否完整
                $flag = false;
            }
            if (empty($store_joinc_info['company_address_detail'])) { //判断详细地址是否完整
                $flag = false;
            }
        } else {
            $flag = false;
        }
    } else {
        $flag = false;
    }
    return $flag;
}

/**
 * 检测客户人员资料是否完整
 * @param $member_id
 * @return bool
 */
function check_info_custom_complete($member_id)
{
    $flag = true;
    if (!empty($member_id)) {
        $member_info = \Ypk\Models\Member::findFirst("member_id=" . $member_id);
        if ($member_info !== false) {
            $member_info = $member_info->toArray();
            if (empty($member_info['member_truename'])) {
                $flag = false;
            }
            if (empty($member_info['member_areainfo'])) {
                $flag = false;
            }
        } else {
            $flag = false;
        }
    } else {
        $flag = false;
    }
    return $flag;
}

/**
 * 更新服务购买记录信息
 * @param array $vrorder_info 虚拟订单实体信息
 */
function update_member_buy_service_num($vrorder_info)
{
    if (!empty($vrorder_info) && is_array($vrorder_info)) {
        $goods_id = $vrorder_info['goods_id'];
        $buyer_id = $vrorder_info['buyer_id'];
        $order_sn = $vrorder_info['order_sn'];

        $memberBuyServiceNum = \Ypk\Models\MemberBuyServiceNum::findFirst("goods_id=" . $goods_id . " and buyer_id=" . $buyer_id . " and order_sn='" . $order_sn . "'");
        if ($memberBuyServiceNum !== false) {
            $memberBuyServiceNum->setIsNew(1);
            $memberBuyServiceNum->setIsExchange(1);
            $memberBuyServiceNum->save();
        }
    }
}

/**
 * 扫描过期的产品，更新其状态
 */
function scan_invalid_goods()
{
    $goods_list=\Ypk\Models\Goods::find("doctor_service_end_time<=".time()." and goods_state=1 and gc_id_1 in (1073,1076)");
    if(count($goods_list)>0){
        //$goods_array=$goods_list->toArray();
        foreach ($goods_list as $key=>$goods){
            $goods->setGoodsState(0);
            $goods->save();
        }
    }
}