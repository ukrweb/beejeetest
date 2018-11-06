<?php

namespace Task\Model;

use Application\Model\TaskEntity;
use Core\Upload;

class Task extends TaskEntity
{
    /**
     * Get all tasks
     */
    public function getAll()
    {
        $query = $this->db->prepare('SELECT * FROM task');
        $query->execute();
        
        return $query->fetchAll();
    }

    /**
     * Get amount tasks
     */
    public function getAmountTasks()
    {
        $query = $this->db->prepare('SELECT COUNT(id) AS amount_of_tasks FROM task');
        $query->execute();

        return $query->fetch()->amount_of_tasks;
    }

    /**
     * Get a task from database
     * @param integer $taskId
     * @return object $db
     */
    public function getTask($taskId)
    {
        $query = $this->db->prepare('SELECT * FROM task WHERE id = :id LIMIT 1');
        $query->execute(array(':id' => $taskId));
        
        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Add a task to database
     * @param array $data Data for add task
     */
    public function addTask(array $data)
    {
        extract($data);
        $sql = 'INSERT INTO task (username, email, comments) VALUES (:userName, :email, :comments)';
        $query = $this->db->prepare($sql);

        $query->execute(array(
            ':userName' => $userName,
            ':email'    => $email,
            ':comments' => $comments
        ));

        $handle = new Upload($_FILES['image']['tmp_name']);
        if ($handle->uploaded) {
            $handle->file_new_name_body   = 'image_' . $this->db->lastInsertId();
            $handle->image_resize         = true;
            $handle->image_x              = 320;
            $handle->image_ratio_y        = true;
            $handle->allowed= [
                'image/jpeg',
                'image/jpeg',
                'image/jpeg',
                'image/gif',
                'image/png'
            ];

            $handle->process($_SERVER['DOCUMENT_ROOT'] . '/img/');
            if ($handle->processed) {
                $handle->clean();

                $query = $this->db->prepare('UPDATE `task` SET image = :image WHERE id = :id');
                $query->execute(array(
                    ':id'     => $this->db->lastInsertId(),
                    ':image'  => $handle->file_dst_name
                ));
            }
        }
    }

    /**
     * Update a task in database
     * @param array $data Data for update task
     */
    public function updateTask(array $data)
    {
        extract($data);
        $query = $this->db->prepare('UPDATE task SET comments = :comments, status = :status WHERE id = :id');

        $query->execute(array (
            ':comments' => $comments,
            ':status'   => $status,
            ':id'       => $taskId
        ));
    }
}