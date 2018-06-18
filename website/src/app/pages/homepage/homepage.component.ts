import { Component, OnInit } from '@angular/core';
import { APIService } from '../../providers/api.service';
import { ProductModel, ResponseModel } from '../../model/api-response';
import { HelperService } from '../../providers/helper.service';
import { Endpoints } from '../../config/endpoints';

@Component({
  selector: 'app-homepage',
  templateUrl: './homepage.component.html',
  styleUrls: ['./homepage.component.scss']
})
export class HomepageComponent implements OnInit {

  products: Array<ProductModel> = [];
  UILoaded: Boolean = false;
  constructor(private api: APIService, private helper: HelperService) {
  }

  ngOnInit() {
    this.helper.setPageName('WeBuy Online');
    this.api.getDashboard().subscribe((res: ResponseModel) => {
      this.products = res.data.map((v, k) => {
        v.offer = this.getRandomOffer();
        v.url = `/${v.category_name}/${this.helper.getSlug(v.product_title)}/${v.product_id}`;
        return v;
      });
      this.UILoaded = true;
    });
  }
  getImageURL(basename) {
    return this.api.getImageHost() + basename;
  }
  getRandomOffer() {
    return Math.floor(Math.random() * 30) + 5;
  }
}
