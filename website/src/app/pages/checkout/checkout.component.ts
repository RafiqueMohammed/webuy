import { Component, OnInit } from '@angular/core';
import { APIService } from '../../providers/api.service';
import { HelperService } from '../../providers/helper.service';
import { CartService } from '../../providers/cart.service';
import { ProductModel, ResponseModel } from '../../model/api-response';

@Component({
  selector: 'app-checkout',
  templateUrl: './checkout.component.html',
  styleUrls: ['./checkout.component.scss']
})
export class CheckoutComponent implements OnInit {

  mycart: Array<ProductModel> = [];
  display: any;
  constructor(private api: APIService, private helper: HelperService, private cart: CartService) { }

  ngOnInit() {
    this.display = { show: false, msg: '', type: 'error' };
    this.helper.setPageName('Checkout');
    this.cart.listener.subscribe(_c => {
      this.mycart = _c.map((v, k) => {
        v.url = `/${v.category_name}/${this.helper.getSlug(v.product_title)}/${v.product_id}`;
        return v;
      });
    });
  }
  removeProduct(product) {
    this.cart.remove(product);

  }
  clearDisplay() {
    this.display.show = false;
    this.display.type = '';
    this.display.msg = '';
  }
  showMessage(_type, _msg) {
    this.display.show = true;
    this.display.type = _type;
    this.display.msg = _msg;

  }
  placeOrder() {
    // Show something while bg process
    this.display.show = true;
    this.display.type = 'info';

    let data = [];
    this.mycart.forEach(v => {
      data.push(v.product_id);
    });

    this.api.placeOrder({ products: data }).subscribe((res: ResponseModel) => {
      if (res.success === true) {
        this.showMessage('success', '');
        this.cart.clear();
      } else {
        this.showMessage('error', res.message);
      }
    }, err => {
      this.showMessage('error', 'Unable to place order. Please try again.');
    });
  }

}
