import type { ArtistMusician } from "./pivots/artist_musician";

export type Musician<T = ArtistMusician> = {
    id: number
    stage_name: string
    real_name: string
    bio: string
    social_links: string[]
    gender: string
    birth_place: string
    pivot?: T
};
