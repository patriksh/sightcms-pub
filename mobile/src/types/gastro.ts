import { Category } from './category';

export type GastroCategory = Category;

export type Gastro = {
    _id: string,
    slug: string,
    name: string,
    location: string,
    content: string,
    image_url: string|null,
    website_link: string,
    url?: string,
    gastro_category_id: number|null,
    gastro_category: GastroCategory|null
}

export type GastrosResponse = {
    gastros: {
        data: Gastro[],
        current_page: number,
        last_page: number,
        per_page: number,
        total: number
    }
}

export type GastroCategoriesResponse = {
    categories: GastroCategory[]
}

export type GastroResponse = {
    gastro: Gastro
}