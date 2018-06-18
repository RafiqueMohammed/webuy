<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;
// Routes
use \Firebase\JWT\JWT;
use \Tuupola\Base62;

$app->group("/cms", function () use ($app) {

    $app->post("/login", function (Request $request, Response $response) use ($app) {

        $post = $request->getParsedBody();
        $username = $post['username'];
        $password = $post['password'];

        if (empty($username) || empty($password)) {
            return $response->withJson(["success" => false, "message" => "Required field missing"]);
        } else {
            $password = sha1($password);
            $qry = "SELECT `username`,`role` from `" . TAB_STAFFS . "` where `username`=? AND `password`=?";
            $stmt = $this->db->prepare($qry);
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $jti = (new Base62)->encode(random_bytes(16));
                $secret = $this->get("settings")['SECRET_KEY_CMS'];
                $payload = [
                    "jti" => $jti,
                    "username" => $result->fetch_assoc()['username'],
                    "role" => $result->fetch_assoc()['role']
                ];

                $token = JWT::encode($payload, $secret, "HS256");
                return $response->withJson(["success" => true, "message" => "Successful", "token" => $token]);
            } else {
                return $response->withJson(["success" => false, "message" => "Username/password doesn't match"]);
            }
        }

    });

    $app->group('/categories', function () use ($app) {
        //UPDATE
        $app->put("/{category_id}", function (Request $request, Response $response, array $args) {
            $post = $request->getParsedBody();
            $name = $post['category_name'];
            $category_id = $args['category_id'];

            if (empty($name)) {
                return $response->withJson(["success" => false, "message" => "Required field missing"]);
            } else {
                $stmt = $this->db->prepare("SELECT category_id from " . TAB_CAT . " where `category_id`=?");
                $stmt->bind_param("i", $category_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $stmt = $this->db->prepare("UPDATE " . TAB_CAT . " SET `category_name`=? WHERE `category_id`=?");
                    $stmt->bind_param("si", $name, $category_id);
                    $stmt->execute();

                    if ($stmt->affected_rows === 0) {
                        return $response->withJson(["success" => false, "message" => "No changes made"]);
                    } else {
                        return $response->withJson(["success" => true, "message" => "Successfully updated"]);
                    }
                } else {
                    return $response->withJson(["success" => false, "message" => "Category doesn't Exist"]);
                }
            }

        });

        //DELETE
        $app->delete("/{category_id}", function (Request $request, Response $response, array $args) {
            $category_id = $args['category_id'];

            //SKIPPING Category exist check, Staff role

            $stmt = $this->db->prepare("DELETE " . TAB_CAT . " WHERE `category_id`=?");
            $stmt->bind_param("i", $category_id);
            $stmt->execute();

            if ($stmt->affected_rows === 0) {
                return $response->withJson(["success" => false, "message" => "Category already deleted or unable to delete"]);
            } else {
                return $response->withJson(["success" => true, "message" => "Successfully deleted"]);
            }

        });

        //READ ALL
        $app->get("", function (Request $request, Response $response, array $args) {
            $result = $this->db->query("SELECT * from " . TAB_CAT);
            if ($result->num_rows > 0) {
                return $response->withJson(["success" => true, "message" => "Success", "data" => $result->fetch_all(MYSQLI_ASSOC)]);
            } else {
                return $response->withJson(["success" => false, "message" => "No categories available"]);
            }

        });

        //CREATE
        $app->post("", function (Request $request, Response $response, array $args) {
            $post = $request->getParsedBody();
            $name = $post['category_name'];

            if (empty($name)) {
                return $response->withJson(["success" => false, "message" => "Required field missing"]);
            } else {
                $stmt = $this->db->prepare("SELECT category_id from " . TAB_CAT . " where `category_name`=?");
                $stmt->bind_param("s", $name);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    return $response->withJson(["success" => false, "message" => "Category already Exist"]);
                } else {
                    $stmt = $this->db->prepare("INSERT INTO " . TAB_CAT . "(`category_name`) VALUES(?)");
                    $stmt->bind_param("s", $name);
                    $stmt->execute();

                    if ($stmt->affected_rows === 0) {
                        return $response->withJson(["success" => false, "message" => "Error occurred while creating category"]);
                    } else {
                        return $response->withJson(["success" => true, "message" => "Successfully created"]);
                    }
                }
            }

        });


    });

    $app->group('/products', function () use ($app) {

        //READ ALL ~ Skipping Pagination
        $app->get("", function (Request $request, Response $response, array $args) {
            $result = $this->db->query("SELECT `product_id`, `product_title`, `product_description`, `product_image`, `category_id`,`category_name`, `product_price`, `product_added_on` from " . TAB_PRODUCTS . " INNER JOIN " . TAB_CAT . " ON category_id=product_category where deleted='false'");
            if ($result->num_rows > 0) {
                return $response->withJson(["success" => true, "message" => "Success", "data" => $result->fetch_all(MYSQLI_ASSOC)]);
            } else {
                return $response->withJson(["success" => false, "message" => "No categories available"]);
            }

        });

        //READ SINGLE
        $app->get("/{product_id}", function (Request $request, Response $response, array $args) {
            $product_id = $args['product_id'];
            $st = $this->db->prepare("SELECT `product_id`, `product_title`, `product_description`, `product_image`, `category_id`,`category_name`, `product_price`,  `product_added_on` from " . TAB_PRODUCTS . " INNER JOIN " . TAB_CAT . " ON category_id=product_category where deleted='false' AND product_id=?");
            $st->bind_param("i", $product_id);
            $st->execute();
            $result = $st->get_result();
            if ($result->num_rows > 0) {
                return $response->withJson(["success" => true, "message" => "Success", "data" => $result->fetch_assoc()]);
            } else {
                return $response->withJson(["success" => false, "message" => "Product doesn't exist"]);
            }

        });

        //CREATE
        $app->post("", function (Request $request, Response $response, array $args) {
            $post = $request->getParsedBody();
            $uploadedFile = $request->getUploadedFiles()['product_image'];

            $required_field = ["product_title", "product_description", "product_category", "product_price"];
            $missing = [];
            array_walk($required_field, function ($v, $k) use ($post, &$missing) {
                if (!array_key_exists($v, $post)) {
                    $missing[] = $v;
                }
            });
            if (count($missing) > 0) {
                return $response->withJson(["success" => false, "message" => implode($missing, ",") . " required!"]);
            } else if (is_null($uploadedFile)) {
                return $response->withJson(["success" => false, "message" => "Product image is missing"]);
            } else {
                $directory = $this->get('upload_directory');
                try {
                    $img_filename = moveUploadedFile($directory, $uploadedFile);
                } catch (Exception $e) {
                    return $response->withJson(["success" => false, "message" => "Error occurred while uploading image"]);

                }
                extract($post);
                $stmt = $this->db->prepare("INSERT INTO " . TAB_PRODUCTS . "(product_title,product_description,product_image,product_category,product_price) VALUES(?,?,?,?,?)");
                $stmt->bind_param("sssss", $product_title, $product_description, $img_filename, $product_category, $product_price);
                $stmt->execute();

                if ($stmt->affected_rows < 1) {
                    return $response->withJson(["success" => false, "message" => "Error occurred while adding product"]);
                } else {
                    return $response->withJson(["success" => true, "message" => "Successfully created"]);
                }

            }

        });

        //UPDATE
        $app->post("/{product_id}", function (Request $request, Response $response, array $args) {
            $post = $request->getParsedBody();
            $product_id = $args['product_id'];
            $uploadedFile = $request->getUploadedFiles()['product_image'];

            $required_field = ["product_title", "product_description", "product_category", "product_price"];
            $missing = [];
            array_walk($required_field, function ($v, $k) use ($post, &$missing) {
                if (!array_key_exists($v, $post)) {
                    $missing[] = $v;
                }
            });
            if (count($missing) > 0) {
                return $response->withJson(["success" => false, "message" => implode($missing, ",") . " required!"]);
            } else {

                $img_qry = "";
                if (!is_null($uploadedFile) && $uploadedFile->getError() === UPLOAD_ERR_OK) {
                    try {

                        $directory = $this->get('upload_directory');
                        $img_filename = moveUploadedFile($directory, $uploadedFile);
                        $img_qry = ", `product_image`='{$img_filename}'";

                    } catch (Exception $e) {
                        return $response->withJson(["success" => false, "message" => "Unable to upload image"]);
                    }
                }
                $stmt = $this->db->prepare("SELECT product_id from " . TAB_PRODUCTS . " where `product_id`=?");
                $stmt->bind_param("i", $product_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    extract($post);
                    $stmt = $this->db->prepare("UPDATE " . TAB_PRODUCTS . " SET `product_title`=?,`product_description`=?, `product_category`=?, `product_price`=? {$img_qry} WHERE `product_id`=?");
                    $stmt->bind_param("ssisi", $product_title, $product_description, $product_category, $product_price, $product_id);
                    $stmt->execute();

                    if ($stmt->affected_rows === 0) {
                        return $response->withJson(["success" => false, "message" => "No changes made"]);
                    } else {
                        return $response->withJson(["success" => true, "message" => "Successfully updated"]);
                    }
                } else {
                    return $response->withJson(["success" => false, "message" => "Product doesn't Exist"]);
                }
            }

        });

        //DELETE
        $app->delete("/{product_id}", function (Request $request, Response $response, array $args) {
            $product_id = $args['product_id'];

            //SKIPPING Product exist check, Staff role

            $stmt = $this->db->prepare("DELETE " . TAB_PRODUCTS . " WHERE `product_id`=?");
            $stmt->bind_param("i", $product_id);
            $stmt->execute();

            if ($stmt->affected_rows === 0) {
                return $response->withJson(["success" => false, "message" => "Product already deleted or unable to delete"]);
            } else {
                return $response->withJson(["success" => true, "message" => "Successfully deleted"]);
            }

        });

    });

    $app->group('/orders', function () use ($app) {

        //READ ALL ~ Skipping Pagination
        $app->get("", function (Request $request, Response $response, array $args) {
            $result = $this->db->query("SELECT fullname,address,email,mobile,order_id,order_on from " . TAB_ORDERS . " inner JOIN " . TAB_USERS . " ON user_id = order_user_id ORDER BY order_id DESC");
            if ($result->num_rows > 0) {
                return $response->withJson(["success" => true, "message" => "Success", "data" => $result->fetch_all(MYSQLI_ASSOC)]);
            } else {
                return $response->withJson(["success" => false, "message" => "No categories available"]);
            }

        });
        $app->get("/{order_id}", function (Request $request, Response $response, array $args) {
            $order_id = $args['order_id'];
            $stmt = $this->db->prepare("SELECT fullname,address,email,mobile,order_id,order_on from " . TAB_ORDERS . " inner JOIN " . TAB_USERS . " ON user_id = order_user_id WHERE order_id=?");
            $stmt->bind_param("i", $order_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if ($result->num_rows > 0) {
                $data = $result->fetch_assoc();

                $st = $this->db->prepare("SELECT product_title,product_id FROM " . TAB_OL . " INNER JOIN " . TAB_PRODUCTS . " ON product_id= ol_product_id where ol_order_id=?");
                $st->bind_param("i", $order_id);
                $st->execute();
                $list_result = $st->get_result();
                $data['products'] = $list_result->fetch_all(MYSQLI_ASSOC);

                return $response->withJson(["success" => true, "message" => "Success", "data" => $data]);
            } else {
                return $response->withJson(["success" => false, "message" => "No categories available"]);
            }

        });

    });

});

$app->group("/web", function () use ($app) {
    $app->group('/categories', function () use ($app) {
        $app->get("", function (Request $request, Response $response, array $args) {
            $result = $this->db->query("SELECT * from " . TAB_CAT);
            if ($result->num_rows > 0) {
                return $response->withJson(["success" => true, "message" => "Success", "data" => $result->fetch_all(MYSQLI_ASSOC)]);
            } else {
                return $response->withJson(["success" => false, "message" => "No categories available"]);
            }

        });
        $app->get("/{category}", function (Request $request, Response $response, array $args) {
            $result = $this->db->query("SELECT `product_id`, `product_title`, `product_description`, `product_image`, `category_id`,`category_name`, `product_price`, `product_added_on` from " . TAB_PRODUCTS . " INNER JOIN " . TAB_CAT . " ON category_id=product_category where deleted='false' AND category_name='{$args['category']}'");
            if ($result->num_rows > 0) {
                return $response->withJson(["success" => true, "message" => "Success", "data" => $result->fetch_all(MYSQLI_ASSOC)]);
            } else {
                return $response->withJson(["success" => false, "message" => "No categories available"]);
            }


        });
    });

    $app->group('/products', function () use ($app) {
        //READ ALL ~ Skipping Pagination
        $app->get("", function (Request $request, Response $response, array $args) {
            $result = $this->db->query("SELECT `product_id`, `product_title`, `product_description`, `product_image`, `category_id`,`category_name`, `product_price`, `product_added_on` from " . TAB_PRODUCTS . " INNER JOIN " . TAB_CAT . " ON category_id=product_category where deleted='false'");
            if ($result->num_rows > 0) {
                return $response->withJson(["success" => true, "message" => "Success", "data" => $result->fetch_all(MYSQLI_ASSOC)]);
            } else {
                return $response->withJson(["success" => false, "message" => "No categories available"]);
            }

        });

        //READ SINGLE
        $app->get("/{product_id}", function (Request $request, Response $response, array $args) {
            $product_id = $args['product_id'];
            $st = $this->db->prepare("SELECT `product_id`, `product_title`, `product_description`, `product_image`, `category_id`,`category_name`, `product_price`,  `product_added_on` from " . TAB_PRODUCTS . " INNER JOIN " . TAB_CAT . " ON category_id=product_category where deleted='false' AND product_id=?");
            $st->bind_param("i", $product_id);
            $st->execute();
            $result = $st->get_result();
            $data = $result->fetch_assoc();
            $data['product_description'] = nl2br($data['product_description'], true);
            if ($result->num_rows > 0) {
                return $response->withJson(["success" => true, "message" => "Success", "data" => $data]);
            } else {
                return $response->withJson(["success" => false, "message" => "Product doesn't exist"]);
            }

        });

    });

    $app->group('/orders', function () use ($app) {

        $app->post("", function (Request $request, Response $response, array $args) {
            $post = $request->getParsedBody();
            if (isset($post['products']) && is_array($post['products'])) {
                //since no login, so getting recent user id for demo purpose
                $result = $this->db->query("select user_id from " . TAB_USERS . " ORDER BY user_id DESC LIMIT 1");
                if ($result->num_rows > 0) {
                    $user_id = $result->fetch_assoc()['user_id'];
                    try {
                        //Init Transaction
                        $this->db->begin_transaction();

                        //Creating base order
                        $order_result = $this->db->query("INSERT INTO " . TAB_ORDERS . "(order_user_id) VALUES('{$user_id}')");
                        if (!$order_result) {
                            throw new Exception($this->db->error);
                        } else {

                            $order_id = $this->db->insert_id;

                            //adding cart list and mapping it to base order
                            $stmt = $this->db->prepare("INSERT INTO " . TAB_OL . "(ol_product_id,ol_order_id) VALUES(?,?)");

                            foreach ($post['products'] as $k => $pid) {
                                $stmt->bind_param("ii", $pid, $order_id);
                                $success = $stmt->execute();
                                if ($success === false) {
                                    throw new Exception($this->db->error);
                                }
                            }

                            $this->db->commit();

                            return $response->withJson(["success" => true, "message" => "Your order places successfully"]);
                        }
                    } catch (Exception $e) {
                        //Transaction fails, so rollback!
                        $this->db->rollback();
                        return $response->withJson(["success" => false, "message" => "Unable to create your order list.", "error" => $e->getMessage()]);
                    }

                } else {
                    return $response->withJson(["success" => false, "message" => "Required field missing"]);

                }

            } else {
                return $response->withJson(["success" => false, "message" => "No user available"]);
            }

        });

    });


});

function moveUploadedFile($directory, UploadedFile $uploadedFile)
{
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
    $filename = sprintf('%s.%0.8s', $basename, $extension);

    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

    return $filename;
}
