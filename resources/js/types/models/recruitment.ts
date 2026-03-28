import type { Artist } from "./artist";
import type { Event } from "./event";

export type Recruitment = {
    id: number
    regency_id: number | null
    regency_name: string | null
    slug: string
    title: string
    description: string
    truncated_description: string
    recruitmentable_id: number
    recruitmentable_type: string
    recruitmentable: Artist | Event
};
