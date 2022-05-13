<?php

// chèn data
$data = file_get_contents( "test.json" );
$users = json_decode( $data, true );

// khởi tạo class File

class File {
    protected $id;
    protected $fullname;
    protected $username;
    protected $password;
    protected $gender;
    protected $email;
    protected $phone;
    protected $avatar;
    protected $address;

    public function __construct( $id, $fullname, $username, $password, $gender, $email, $phone, $avatar, $address ) {
        $this->id = $id;
        $this->fullname = $fullname;
        $this->username = $username;
        $this->password = $password;
        $this->gender = $gender;
        $this->email = $email;
        $this->phone = $phone;
        $this->avatar = $avatar;
        $this->address = $address;
    }

    public function __get( $name ) {
        return $this->$name;
    }

    public function __set( $name, $value ) {
        $this->$name = $value;
    }
}

// khởi tạo các mảng để chứa các giá trị

$id = [];
$fullname = [];
$username = [];
$password = [];
$gender = [];
$email = [];
$phone = [];
$avatar = [];
$address = [];

// lặp qua data để truyền dữ liệu vào các mảng
foreach ( $users as $key => $value ) {
    # code...
    $id[] = $value['id'];
    $fullname[] = $value['fullname'];
    $username[] = $value['username'];
    $password[] = $value['password'];
    $phone[] = $value['phone'];
    $gender[] = $value['gender'];
    $email[] = $value['email'];
    $avatar[] = $value['avatar'];
    $address[] = $value['address'];
}

// bây giờ các mảng đã hứng được dữ liệu

// nhét từng mảng vào trong class File
$file = new File( $id, $fullname, $username, $password, $gender, $email, $phone, $avatar, $address );


// hàm trả về mảng cần tìm trong 1 mảng 2 chiềU
function search( $array, $key, $value ) {
    $results = array();

    if ( is_array( $array ) ) {
        if ( isset( $array[$key] ) && $array[$key] == $value ) {
            $results[] = $array;
        }

        foreach ( $array as $subarray ) {
            $results = array_merge( $results, search( $subarray, $key, $value ) );
        }
    }

    return $results;
}
// khởi tạo class User từ class File

class User extends File {
    public function add( $new_id, $new_fullname, $new_username, $new_password, $new_gender, $new_email, $new_phone, $new_avatar, $new_address ) {

        // nhét giá trị mới vào từng mảng
        array_push( $this->id, $new_id );
        array_push( $this->fullname, $new_fullname );
        array_push( $this->username, $new_username );
        array_push( $this->password, $new_password );
        array_push( $this->gender, $new_gender );
        array_push( $this->email, $new_email );
        array_push( $this->phone, $new_phone );
        array_push( $this->avatar, $new_avatar );
        array_push( $this->address, $new_address );
        // khởi tạo một mảng 2 chiều
        $all = [];
        $data = [];
        $all[] = $data;

        // dựa vào id để lấy vòng lặp
        foreach ( $this->id as $key => $value ) {
            // xử lý thêm giá trị vào từng mảng một nhờ key
            $all[$key]['id'] = $value;
            $all[$key]['fullname'] = $this->fullname[$key];
            $all[$key]['username'] = $this->username[$key];
            $all[$key]['password'] = $this->password[$key];
            $all[$key]['phone'] = $this->phone[$key];
            $all[$key]['gender'] = $this->gender[$key];
            $all[$key]['email'] = $this->email[$key];
            $all[$key]['avatar'] = $this->avatar[$key];
            $all[$key]['address'] = $this->address[$key];
        }

        // chuyển data all sang json unicode
        $jsonData = json_encode( $all, JSON_UNESCAPED_UNICODE );

        // ghi vào file json
        file_put_contents( 'test.json', $jsonData );

    }

    public function find_index( $id ) {

        // khởi tạo một mảng 2 chiều
        $all = [];
        $data = [];
        $all[] = $data;

        // dựa vào id để lấy vòng lặp
        foreach ( $this->id as $key => $value ) {
            // xử lý thêm giá trị vào từng mảng một nhờ key
            $all[$key]['id'] = $value;
            $all[$key]['fullname'] = $this->fullname[$key];
            $all[$key]['username'] = $this->username[$key];
            $all[$key]['password'] = $this->password[$key];
            $all[$key]['phone'] = $this->phone[$key];
            $all[$key]['gender'] = $this->gender[$key];
            $all[$key]['email'] = $this->email[$key];
            $all[$key]['avatar'] = $this->avatar[$key];
            $all[$key]['address'] = $this->address[$key];
        }
        //hàm xử lý tìm mảng chứa id

        
        //lưu mảng đã tìm đc vào $find_user
        // echo '<pre>';
        $find_user = search( $all, 'id', $id );
        // echo '</pre>';

        //lặp qua users để
        foreach ( $all as $key => $value ) {
            //    so sánh 2 mảng
            if ( $value == $find_user[0] ) {
                # lấy key truyền vào $index
                $index = $key;
            }
        }
        //đã bắt được index của mảng chứa id
        return $index;

    }

    //    phương thức chuyển object sang array

    public function fetch() {
        // khởi tạo một mảng 2 chiều
        $all = [];
        $data = [];
        $all[] = $data;

        // dựa vào id để lấy vòng lặp
        foreach ( $this->id as $key => $value ) {
            // xử lý thêm giá trị vào từng mảng một nhờ key
            $all[$key]['id'] = $value;
            $all[$key]['fullname'] = $this->fullname[$key];
            $all[$key]['username'] = $this->username[$key];
            $all[$key]['password'] = $this->password[$key];
            $all[$key]['phone'] = $this->phone[$key];
            $all[$key]['gender'] = $this->gender[$key];
            $all[$key]['email'] = $this->email[$key];
            $all[$key]['avatar'] = $this->avatar[$key];
            $all[$key]['address'] = $this->address[$key];
        }
        return $all;
    }

    public function update( $users, $index, $new_fullname, $new_username, $new_password, $new_email, $new_phone, $new_address, $new_gender, $new_avatar ) {

        $users[$index]['fullname'] = $new_fullname;
        $users[$index]['username'] = $new_username;
        $users[$index]['password'] = $new_password;
        $users[$index]['email'] = $new_email;
        $users[$index]['phone'] = $new_phone;
        $users[$index]['address'] = $new_address;
        $users[$index]['gender'] = $new_gender;
        $users[$index]['avatar'] = $new_avatar;

        $jsonData = json_encode( $users, JSON_UNESCAPED_UNICODE );

        var_dump( $jsonData );
        file_put_contents( 'test.json', $jsonData );
    }

    public function delete( $users, $id ) {

        $user = search( $users, 'id', $id );

        foreach ( $users as $key => $value ) {
            if ( $value == $user[0] ) {
                # code...
                echo $key;
                unset( $users[$key] );
            }
        }

        //sắp xếp lại key
        $users = array_values( $users );
        $jsonData = json_encode( $users, JSON_UNESCAPED_UNICODE );

        file_put_contents( 'test.json', $jsonData );
    }
}
// khởi tạo class User
$user = new User( $id, $fullname, $username, $password, $gender, $email, $phone, $avatar, $address );

