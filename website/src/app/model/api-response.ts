export interface CategoryModel {
    category_id: string;
    category_name: string;
    category_created_on: string;
}

export interface ProductModel {
    product_id: string;
    product_title: string;
    product_description: string;
    product_image: string;
    category_id: string;
    category_name: string;
    product_price: string;
    product_added_on: string;
}

export interface ResponseModel {
    success: boolean;
    message: string;
    data: any;
    info?: any;
}

