import { ShortStoryModel } from './story.model';

export interface SectionModel {
    section: Number;
    sectionName: String;
    color?: String;
    data: Array<ShortStoryModel>;
}
