import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs/BehaviorSubject';
@Injectable()
export class HelperService {

  PageNameListener = new BehaviorSubject<String>('');

  constructor() { }

  setPageName(name: String) {
    this.PageNameListener.next(name);
  }

  getSlug(txt) {
    return txt.toLowerCase()
      .replace(/ /g, '-')
      .replace(/[^\w-]+/g, '');
  }
}
