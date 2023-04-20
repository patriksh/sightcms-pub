export type AudioTour = {
    _id: string,
    slug: string,
    title: string
    duration: string,
    image_url: string|null,
    content?: string,
    file_url?: string,
    file_size?: string,
    url?: string
}

export type AudioToursResponse = {
    audioTours: {
        data: AudioTour[],
        current_page: number,
        last_page: number,
        per_page: number,
        total: number
    }
}

export type AudioTourResponse = {
    audioTour: AudioTour
}

