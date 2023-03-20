import { useEffect, useState } from "react";
import { Head } from "@inertiajs/react";
import Authenticated from "@/Layouts/Authenticated";
import { Link } from "@inertiajs/react";
import AddModal from "@/Components/AddModal";
import Loading from "@/Components/Loading";
import axios from "axios";
import StarRating from "react-awesome-stars-rating";

const Index = (props: any) => {
    console.log("index", props);
    const [movies, setMovies] = useState(props.movies);

    const [doneFlag, setDoneFlag] = useState(false);

    const [editFlag, setEditFlag] = useState(false);

    const [loading, setLoading] = useState(false);

    const [showModal, setShowModal] = useState(false);

    const [additionalMovieValue, setAdditionalMovieValue] = useState({
        title: "",
        memo: "",
        poster_path: "",
    });

    const [toEditMovieValue, setToEditMovieValue] = useState({
        id: "",
        title: "",
        memo: "",
        poster_path: "",
        is_done: 0,
        date: "",
        star: 0,
    });

    useEffect(() => {
        if (typeof props.additionalMovie != "undefined") {
            setAdditionalMovieValue({
                ...additionalMovieValue,
                title: props.additionalMovie.title,
                memo: props.keepValue
                    ? props.keepValue.memo
                    : props.toEditMovie.memo,
                poster_path: props.additionalMovie.poster_path,
            });
        }
    }, []);

    useEffect(() => {
        if (props.editFlag) {
            setToEditMovieValue({
                ...toEditMovieValue,
                id: props.keepValue ? props.keepValue.id : props.toEditMovie.id,
                title: props.toEditMovie.title,
                memo: props.keepValue
                    ? props.keepValue.memo
                    : props.toEditMovie.memo,
                poster_path: props.toEditMovie.poster_path,
            });
        }
    }, []);

    // useEffect(() => {
    //     setShowModal(props.showFlag);
    // }, []);

    // useEffect(() => {
    //     setEditFlag(props.editFlag);
    // }, [props.editFlag]);

    const getWant = async () => {
        await axios.get("/api/want").then((res) => {
            setMovies(res.data);
        });
        setDoneFlag(false);
    };

    const getDone = async () => {
        await axios.get("/api/done").then((res) => {
            setMovies(res.data);
        });
        setDoneFlag(true);
    };

    const getToEdit = async (e) => {
        console.log(e);
        await axios
            .get("/api/edit", {
                params: {
                    id: e.target.id,
                },
            })
            .then((res) => {
                console.log(res.data);
                setToEditMovieValue({
                    ...toEditMovieValue,
                    id: res.data.id,
                    title: res.data.title,
                    memo: res.data.memo,
                    poster_path: res.data.poster_path,
                    is_done: res.data.is_done,
                    date: res.data.date,
                    star: res.data.star,
                });
            });
        setShowModal(true);
        setEditFlag(true);
    };

    useEffect(() => {
        if (typeof props.doneFlag != "undefined") {
            setDoneFlag(props.doneFlag);
        }
    }, [props.doneFlag]);

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
                    additionalMovieValue={additionalMovieValue}
                    setAdditionalMovieValue={setAdditionalMovieValue}
                    setLoading={setLoading}
                    editFlag={editFlag}
                    setEditFlag={setEditFlag}
                    toEditMovieValue={toEditMovieValue}
                    setToEditMovieValue={setToEditMovieValue}
                    doneFlag={doneFlag}
                    setDoneFlag={setDoneFlag}
                    getDone={getDone}
                    getWant={getWant}
                />

                <Loading loading={loading} />

                <section className="body-font text-white bg-gray-900">
                    <div className="container flex justify-center flex-wrap items-center mx-auto">
                        <div
                            className="items-center justify-between hidden w-full md:flex md:w-auto md:order-1"
                            id="navbar-sticky"
                        >
                            <div>
                                <button onClick={getWant}>Want to</button>
                            </div>
                            <div>
                                <button onClick={getDone}>Done</button>
                            </div>
                        </div>
                    </div>

                    <div className="container px-5 py-24 mx-auto">
                        <div className="flex flex-wrap -m-4">
                            {movies.map((movie: any, index: number) => (
                                <div key={index} className="p-4 w-1/5">
                                    <div className="h-full border-none border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden bg-gray-800">
                                        {/* <Link
                                            href={route(
                                                "want.movie.update.index",
                                                { id: movie.id }
                                            )}
                                        > */}
                                        <img
                                            className="lg:h-80 md:h-60 w-full object-cover object-center"
                                            src={movie.poster_path}
                                            alt="blog"
                                            onClick={getToEdit}
                                            id={movie.id}
                                        />
                                        {/* </Link> */}
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
                                            {doneFlag && (
                                                <div className="[&>span]:flex">
                                                    <p className="text-xs">
                                                        {movie.date}
                                                    </p>
                                                    <StarRating
                                                        isEdit="false"
                                                        size="15"
                                                        value={movie.star}
                                                    />
                                                </div>
                                            )}
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
