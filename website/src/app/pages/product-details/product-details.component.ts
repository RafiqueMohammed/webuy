import { Component, OnInit } from '@angular/core';
import { Endpoints } from '../../config/endpoints';
import { APIService } from '../../providers/api.service';
import { HelperService } from '../../providers/helper.service';
import { ProductModel, ResponseModel } from '../../model/api-response';
import { ActivatedRoute } from '@angular/router';
import { CartService } from '../../providers/cart.service';

@Component({
  selector: 'app-product-details',
  templateUrl: './product-details.component.html',
  styleUrls: ['./product-details.component.scss']
})
export class ProductDetailsComponent implements OnInit {
  product: ProductModel;
  message = '';
  productExist: Boolean = false;
  UILoaded: Boolean = false;
  constructor(private api: APIService, private helper: HelperService, private aRoute: ActivatedRoute, private cart: CartService) { }

  ngOnInit() {
    this.aRoute.params.subscribe(params => {
      this.api.getProduct(params.pid).subscribe((res: ResponseModel) => {
        this.UILoaded = true;
        if (res.success === true) {
          this.helper.setPageName(res.data.product_title);
          this.product = res.data;
          this.productExist = true;
        } else {
          this.message = res.message;
          this.productExist = false;
        }
      });
    });
  }
  addToCart(product: ProductModel) {
    this.cart.add(product);
  }
  getImageURL(basename: String) {
    return this.api.getImageHost() + basename;
  }
}
