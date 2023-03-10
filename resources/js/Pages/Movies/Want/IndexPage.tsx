import React, { useEffect, useState } from "react";
import { Head } from "@inertiajs/react";
import Authenticated from "@/Layouts/Authenticated";
import { Link } from "@inertiajs/react";
import { router } from "@inertiajs/react";
import AddModal from "@/Components/AddModal";
import Loading from "@/Components/Loading";

const Index = (props: any) => {
    // console.log(props.movies);
    // console.log(typeof props.additionalMovie);

    const [loading, setLoading] = useState(false);

    const [showModal, setShowModal] = useState(false);
    const [additionalMovieValue, setAdditionalMovieValue] = useState({
        title: "",
        poster_path: "",
    });

    useEffect(() => {
        if (typeof props.additionalMovie != "undefined") {
            setAdditionalMovieValue({
                ...additionalMovieValue,
                title: props.additionalMovie.title,
                poster_path: props.additionalMovie.poster_path,
            });
        }

        // console.log("useEffecct");
    }, []);

    useEffect(() => {
        setShowModal(props.showFlag);
    }, []);

    return (
        <Authenticated
            auth={props.auth}
            showModal={showModal}
            setShowModal={setShowModal}
        >
            <Head title="Movie" />

            <>
                <AddModal
                    showFlag={showModal}
                    setShowModal={setShowModal}
                    auth={props.auth}
                    // passedShowFlag={props.showFlag}
                    additionalMovieValue={additionalMovieValue}
                    setAdditionalMovieValue={setAdditionalMovieValue}
                    setLoading={setLoading}
                />

                <Loading loading={loading} />

                <section className="body-font text-white bg-gray-900">
                    <div className="container px-5 py-24 mx-auto">
                        <div className="flex flex-wrap -m-4">
                            {props.movies.map((movie: any, index: number) => (
                                <div key={index} className="p-4 w-1/5">
                                    <div className="h-full border-none border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden bg-gray-800">
                                        <Link href={route("want.movie.index")}>
                                            <img
                                                className="lg:h-80 md:h-60 w-full object-cover object-center"
                                                src={movie.image}
                                                alt="blog"
                                            />
                                        </Link>
                                        <div className="p-6">
                                            <h2 className="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">
                                                MOVIE
                                            </h2>
                                            <h1 className="title-font text-lg font-medium text-white mb-3">
                                                {movie.title}
                                            </h1>
                                            <p className="leading-relaxed mb-3 text-xs text-slate-300">
                                                {movie.memo}
                                            </p>
                                            <div className="flex items-center flex-wrap "></div>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </section>
            </>
        </Authenticated>
    );
};

export default Index;