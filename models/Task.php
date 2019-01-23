<?php

class Task extends Model
{
    const TASKS_ON_PAGE = 3;

    public function validateEmail($email)
    {

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public function create()
    {
        mysqli_report(MYSQLI_REPORT_ALL);
        echo 0;
        if (isset($_POST['user']) && isset($_POST['email']) && isset($_POST['text'])) {
            echo 0;
            if (!is_numeric($_POST['user']) && $this->validateEmail($_POST['email'])) {
                echo 0;
                if (isset($_POST['state'])) {
                    $state = 1;
                } else {
                    $state = 0;
                }
                echo 0;
                if ($mysqli = $this->connectDb()) {
                    echo 0;
                    $user = $_POST['user'];
                    $email = $_POST['email'];
                    $text = $_POST['text'];

                    $query = "INSERT INTO task (`user`, `email`, `text`, `state`) VALUES (?,?,?,?)";
                    $stmt = $mysqli->prepare($query);
                    if ($stmt) {
                        echo 0;
                        $stmt->bind_param("sssi", $user, $email, $text, $state);
                        $stmt->execute();
                        $stmt->close();
                        $mysqli->close();
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public function getData()
    {
        if ($mysqli = $this->connectDb()) {

            $cur_page = 1;
            $per_page = self::TASKS_ON_PAGE;
            if (isset($_GET['page']) && $_GET['page'] > 0) {
                $cur_page = $_GET['page'];
            }
            $start = ($cur_page - 1) * $per_page;

            if ($result = $mysqli->query("SELECT COUNT(*) FROM task")) {
                if ($result) {
                    $row_cnt = $result->fetch_row()[0];
                    $result->close();

                    session_start();
                    if (isset($_SESSION['orderBy']) && isset($_SESSION['sort'])) {
                        $orderBy = $_SESSION['orderBy'];
                        $sort = $_SESSION['sort'];
                    } else if (isset($_POST['orderBy']) && $_POST['sort']) {
                        $orderBy = $_POST['orderBy'];
                        $sort = $_POST['sort'];
                        $_SESSION['orderBy'] = $orderBy;
                        $_SESSION['sort'] = $sort;
                    }
                    if (isset($orderBy) && isset($sort)) {
                        $query = "SELECT * FROM task ORDER BY `$orderBy` $sort LIMIT $start, $per_page";
                    } else {
                        $query = "SELECT * FROM task LIMIT $start, $per_page";
                    }

                    if ($result = $mysqli->query($query)) {
                        if ($result) {
                            $array = $result->fetch_all(MYSQLI_ASSOC);
                            $result->close();
                            $mysqli->close();
                            array_push($array, ceil($row_cnt / $per_page));
                            return $array;
                        }
                    }
                }

            }
        }
        return false;
    }



    public function delete()
    {
        if (isset($_GET['tid'])) {
            $tid = $_GET['tid'];
            if ($mysqli = $this->connectDb()) {


                $stmt = $mysqli->prepare("DELETE FROM task WHERE `id` = ?");
                if ($stmt) {
                    $stmt->bind_param("i", $tid);
                    $stmt->execute();
                    $stmt->close();
                    $mysqli->close();
                }
            }
        }
    }


    public function update()
    {
        if ($mysqli = $this->connectDb()) {
            if (isset($_GET['tid'])) {
                $tid = $_GET['tid'];
                $query = "SELECT * FROM task WHERE `id` = $tid";
                if ($result = $mysqli->query($query)) {
                    if ($result) {
                        $array = $result->fetch_assoc();
                        $result->close();
                        $mysqli->close();
                        return $array;
                    }
                }
            } else if (isset($_POST['text']) && isset($_POST['id'])) {
                if (isset($_POST['state'])) {
                    $state = 1;
                } else {
                    $state = 0;
                }
                $text = $_POST['text'];
                $id = $_POST['id'];

                $stmt = $mysqli->prepare("UPDATE task SET `text` = ?, `state` = ? WHERE `id` = ?");
                if ($stmt) {
                    $stmt->bind_param("sii", $text, $state, $id);
                    $stmt->execute();
                    $stmt->close();
                    $mysqli->close();
                }
            }
        }
        return false;
    }

}
