<?php

namespace Kanboard\Formatter;

/**
 * Class UserMentionFormatter
 *
 * @package Kanboard\Formatter
 * @author  Frederic Guillot
 */
class UserMentionFormatter extends BaseFormatter
{
    protected $users = array();

    /**
     * Set users
     *
     * @param array $users
     * @return $this
     */
    public function withUsers(array $users) {
        $this->users = $users;
        return $this;
    }

    /**
     * Apply formatter
     *
     * @access public
     * @return array
     */
    public function format()
    {
        $result = array();

        foreach ($this->users as $user) {
            $html = $this->helper->avatar->small(
                $user['id'],
                $user['username'],
                $user['name'],
                $user['email'],
                $user['avatar_path'],
                'avatar-inline'
            );

            $html .= ' '.$this->helper->text->e($user['username']);

            if (! empty($user['name'])) {
                $html .= ' <small>'.$this->helper->text->e($user['name']).'</small>';
            }

            $result[] = array(
                'value' => $user['username'],
                'html' => $html,
            );
        }

        return $result;
    }
}