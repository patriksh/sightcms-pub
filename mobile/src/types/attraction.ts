import { Category } from './category';

export type AttractionCategory = Category;

export type Attraction = {
    _id: string,
    slug: string,
    name: string,
    location: string,
    content: string,
    image_url: string|null,
    website_link: string,
    url?: string,
    attraction_category_id: number|null,
    attraction_category: AttractionCategory|null
}

export type AttractionsResponse = {
    attractions: {
        data: Attraction[],
        current_page: number,
        last_page: number,
        per_page: number,
        total: number
    }
}

export type AttractionCategoriesResponse = {
    categories: AttractionCategory[]
}

export type AttractionResponse = {
    attraction: Attraction
}